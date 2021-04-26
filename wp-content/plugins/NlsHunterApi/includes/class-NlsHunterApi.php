<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://example.com
 * @since      2.0.0
 *
 * @package    NlsHunterApi
 * @subpackage NlsHunterApi/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      2.0.0
 * @package    NlsHunterApi
 * @subpackage NlsHunterApi/includes
 * @author     Your Name <email@example.com>
 */
require_once 'class-NlsHunterApi-model.php';
require_once 'class-NlsHunterApi-modules.php';

class NlsHunterApi
{
	const AUTH_SERVER_IP = ['132.64.52.106', '132.64.3.5', '172.21.0.1', '105.29.67.54'];
	const AUTH_TOKEN_EXPERITION = 1000 * 60 * 60; // One hour
	const AUTH_IP_EXPERITION = 1000 * 60 * 60 * 24; // One hour
	const SEARCH_PAGE_SLUG = 'search_page';
	const SEARCH_RESULTS_PAGE_SLUG = 'search_results_page';
	const JOB_DETAILS_PAGE_SLUG = 'job_deatails_page';

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    2.0.0
	 * @access   protected
	 * @var      NlsHunterApi_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    2.0.0
	 * @access   protected
	 * @var      string    $NlsHunterApi    The string used to uniquely identify this plugin.
	 */
	protected $NlsHunterApi;

	/**
	 * The current version of the plugin.
	 *
	 * @since    2.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * The job search results.
	 *
	 * @since    2.0.0
	 * @access   public
	 * @var      array    $searchResultJobs    The jobs of the search result.
	 */
	private $searchResultJobs;

	/**
	 * The job details of the current job Id.
	 *
	 * @since    2.0.0
	 * @access   public
	 * @var      array    $jobDetails    The jobs of the search result.
	 */
	private $jobDetails;

	/**
	 * The model instance
	 */
	private $model;

	/**
	 * The modules instance
	 */
	private $modules;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    2.0.0
	 */
	public function __construct()
	{
		// Make sure the user is validated and can login
		if (defined('NlsHunterApi_VERSION')) {
			$this->version = NlsHunterApi_VERSION;
		} else {
			$this->version = '2.0.0';
		}
		$this->NlsHunterApi = 'NlsHunterApi';

		add_action('plugins_loaded', [$this, 'action_validate_user']);

		$this->load_dependencies();


		$this->set_locale();

		// Instantiate the modules class
		try {
			$this->model = new NlsHunterApi_model();
			$this->model->initCardService();

			$this->modules = new NlsHunterApi_modules($this->model);
		} catch (\Exception $e) {
			$this->addErrorToPage($e->getMessage(), "Error: Could not create Niloos Module.");
			return null;
			//throw new \Exception("Error: Could not create Niloos Module.\n" . $e->getMessage());
		}

		$this->define_admin_hooks();
		$this->define_shortcodes();
		$this->define_public_hooks();
	}


	public	function write_log($log)
	{
		if (true === WP_DEBUG) {
			if (is_array($log) || is_object($log)) {
				error_log(print_r($log, true));
			} else {
				error_log($log);
			}
		}
	}


	public function action_validate_user()
	{
		$ip     = $_SERVER['REMOTE_ADDR']; //$_POST['ip'];
		$zehut  = key_exists('zehut', $_POST) ? $_POST['zehut'] : null;

		$this->write_log('THIS IS THE START OF MY CUSTOM DEBUG');
		$this->write_log('IP: REMOTE_ADDR: ' . $ip);
		$this->write_log('IP: zehut: ' . $zehut);

		if (in_array($ip, self::AUTH_SERVER_IP) && $zehut !== null) {
			$token = $this->huji_auth_update($ip, $zehut);
			$status = $token ? 200 : 403;
			wp_send_json(['token' => $token], $status);
			wp_die();
		}

		// Check bearer token
		$token = $this->getBearerToken();
		if ($this->valid_token($token)) return;

		$token = key_exists('token', $_POST) ? $_POST['token'] : null;
		$this->write_log('IP: token: ' . $token);

		if ($this->valid_token($token)) {
			$this->huji_auth_update($ip, $zehut, $token);
			return;
		}

		if ($this->valid_ip($ip)) return;

		wp_redirect('https://huji.hunterhrms.com/');
		exit;
	}

	private function valid_token($token)
	{
		if (!$token) return false;

		global $wpdb;
		$table_name = $wpdb->prefix . "auth_token";
		$sqlQuery = "SELECT * FROM " . $table_name . " WHERE token='" . $token . "'";
		$row = $wpdb->get_row($sqlQuery);
		if ($row){
			$this->write_log('ROW:token ' . $row->token);
			$this->write_log('ROW:token ' . $row->ts);
		}
		$this->write_log('ROW:valid token ' . $row && $row->token === $token && time() - $row->ts < self::AUTH_TOKEN_EXPERITION);
		
		return $row && $row->token === $token && time() - $row->ts < self::AUTH_TOKEN_EXPERITION;
	}

	private function valid_ip($ip)
	{
		if (!$ip) return false;

		global $wpdb;
		$table_name = $wpdb->prefix . "auth_token";
		$sqlQuery = "SELECT * FROM " . $table_name . " WHERE ip='" . $ip . "'";

		$row = $wpdb->get_row($sqlQuery);
		return $row && time() - $row->ts < self::AUTH_IP_EXPERITION;
	}

	private function huji_auth_update($ip, $zehut, $token = false)
	{
		$ts 	= time();

		global $wpdb;
		$table_name = $wpdb->prefix . "auth_token";

		if ($token) {
			$fields = [
				'ip' => $ip,
				'ts' => $ts,
			];
			$setup = ['%s', '%d'];
			$res = $wpdb->update($table_name, $fields, ['zehut' => $zehut], $setup);
		} else {
			$token = hash('ripemd160', $ip . $zehut . $ts);
			$fields = [
				'ip' => $ip,
				'zehut' => $zehut,
				'ts' => $ts,
				'token' => $token
			];
			$setup = ['%s', '%s', '%d', '%s'];
			$res = $wpdb->replace($table_name, $fields, $setup);
		}


		return $res === false ? null : $token;
	}

	/** 
	 * Get header Authorization
	 * */
	private function getAuthorizationHeader()
	{
		$headers = null;
		if (isset($_SERVER['Authorization'])) {
			$headers = trim($_SERVER["Authorization"]);
		} else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
			$headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
		} elseif (function_exists('apache_request_headers')) {
			$requestHeaders = apache_request_headers();
			// Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
			$requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
			//print_r($requestHeaders);
			if (isset($requestHeaders['Authorization'])) {
				$headers = trim($requestHeaders['Authorization']);
			}
		}
		return $headers;
	}

	/**
	 * get access token from header
	 * */
	private function getBearerToken()
	{
		$headers = $this->getAuthorizationHeader();
		// HEADER: Get the access token from the header
		if (!empty($headers)) {
			if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
				return $matches[1];
			}
		}
		return null;
	}


	public function addFlash($message, $subject = '', $type = 'info')
	{
		$flash = '<div class="nls-flash-message-wrapper flex">';
		$flash .= '<div class="nls-flash-message ' . $type . '">';
		$flash .= '<div><strong>' . $subject . '</strong> ' . $message . '</div><strong>x</strong>';
		$flash .= '</div></div>';
		return $flash;
	}

	public function addErrorToPage($message, $subject)
	{
		add_action('the_post', function () use ($message, $subject) {
			echo $this->addFlash(
				$message,
				$subject,
				'error'
			);
		});
	}

	public function renderMetas()
	{
		$meta = '<meta property="og:image" content="' . wp_upload_dir()['baseurl'] . '/images/share.png" />' . "\n";
		$meta .= '<meta property="og:image:type" content="image/png" />' . "\n";
		$meta .= '<meta property="og:image:width" content="600" />' . "\n";
		$meta .= '<meta property="og:image:height" content="314" />' . "\n";
		$meta .= '<meta property="og:type" content="website" />' . "\n";

		$slogen = "האוניברסיטה העברית בירושלים";

		if ($this->jobDetails) {
			$title =  $slogen;
			$description = htmlspecialchars(strip_tags($this->jobDetails['JobTitle']));
			$url = add_query_arg(['jobcode' => $this->jobDetails['JobCode']], get_permalink());

			$meta .= '<meta property="og:title" content="' . $title . '" />' . "\n";
			$meta .= '<meta property="twitter:title" content="' . $title . '" />' . "\n";
			$meta .= '<meta property="og:description" content="' . $description . '" />' . "\n";
			$meta .= '<meta property="og:url" content="' . $url . '" />' . "\n";
		} else {
			$meta .= '<meta property="og:title" content="' . $slogen . '" />' . "\n";
			$meta .= '<meta property="twitter:title" content="' . $slogen . '" />' . "\n";
			$meta .= '<meta property="og:description" content="" />' . "\n";
		}

		echo $meta;
	}

	/**
	 *  Load the search results or the job details
	 *  If Search Results page loads the jobs to $searchResultJobs
	 *  If JobDetails Loads the Job Data to $jobDetails
	 * */
	public function loadPluginData()
	{
		$currentPageId = get_queried_object_id();
		$pageJobDetailsId = intval(get_option(NlsHunterApi_Admin::NLS_JOB_DETAILS_PAGE));
		$pageSearchResultsId = intval(get_option(NlsHunterApi_Admin::NLS_SEARCH_RESULTS_PAGE));

		switch ($currentPageId) {
			case $pageJobDetailsId:
				$this->jobDetails = $this->model->getNlsHunterJobDetails();
				break;
			case $pageSearchResultsId:
				break;
			default:
				break;
		}
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - NlsHunterApi_Loader. Orchestrates the hooks of the plugin.
	 * - NlsHunterApi_i18n. Defines internationalization functionality.
	 * - NlsHunterApi_Admin. Defines all hooks for the admin area.
	 * - NlsHunterApi_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    2.0.0
	 * @access   private
	 */
	private function load_dependencies()
	{

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-NlsHunterApi-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-NlsHunterApi-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-NlsHunterApi-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-NlsHunterApi-public.php';

		$this->loader = new NlsHunterApi_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the NlsHunterApi_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    2.0.0
	 * @access   private
	 */
	private function set_locale()
	{

		$plugin_i18n = new NlsHunterApi_i18n();

		$this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    2.0.0
	 * @access   private
	 */
	private function define_admin_hooks()
	{

		$plugin_admin = new NlsHunterApi_Admin($this->get_NlsHunterApi(), $this->get_version());

		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
		$this->loader->add_action('admin_menu', $plugin_admin, 'NlsHunterApi_plugin_menu');
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    2.0.0
	 * @access   private
	 */
	private function define_public_hooks()
	{
		// Set to true to get log messages in file /logs/default.log
		$debug = true;

		$plugin_public = new NlsHunterApi_Public($this->get_NlsHunterApi(), $this->get_version(), $debug);

		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');
		$this->loader->add_action('wp_body_open', $plugin_public, 'add_code_on_body_open');

		// THE AJAX SEARCH RESULTS PAGER ADD ACTIONS
		$this->loader->add_action('wp_ajax_search_results_pager_function', $plugin_public, 'search_results_pager_function');
		$this->loader->add_action('wp_ajax_nopriv_search_results_pager_function', $plugin_public, 'search_results_pager_function'); // need this to serve non logged in users

		// THE AJAX APPLY CV ADD ACTIONS
		$this->loader->add_action('wp_ajax_apply_cv_function', $plugin_public, 'apply_cv_function');
		$this->loader->add_action('wp_ajax_nopriv_apply_cv_function', $plugin_public, 'apply_cv_function'); // need this to serve non logged in users

		// THE AJAX SEND DOCUMENTS ADD ACTIONS
		$this->loader->add_action('wp_ajax_send_document_function', $plugin_public, 'send_document_function');
		$this->loader->add_action('wp_ajax_nopriv_send_document_function', $plugin_public, 'send_document_function'); // need this to serve non logged in users

		// Configure PHPMailer SMTP Mail (wp_mail will use that)
		//$this->loader->add_action( 'phpmailer_init', $plugin_public, 'configure_smtp' );

		// The head metas set action
		// Set the JobDetails if the job details page is required
		$this->loader->add_action('wp_head', $this, 'loadPluginData');

		// Execute after jobdetails set to render correct Meta
		$this->loader->add_action('wp_head', $this, 'renderMetas', 20);
	}

	/**
	 * Register all of the shortcodes related to the plugin
	 *
	 * @since    2.0.0
	 * @access   private
	 */
	private function define_shortcodes()
	{

		// Add Shortcode
		add_shortcode('nls_hunter_search', [$this->modules, 'nlsHunterSearch']);
		add_shortcode('nls_hunter_search_results', [$this->modules, 'nlsHunterSearchResults']);
		add_shortcode('nls_hunter_job_details', [$this->modules, 'nlsHunterJobDetails']);
		add_shortcode('nls_hunter_social', [$this->modules, 'nlsHunterSocial']);
		add_shortcode('nls_recruit_process', [$this->modules, 'nlsRecruitProcess']);
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    2.0.0
	 */
	public function run()
	{
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     2.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_NlsHunterApi()
	{
		return $this->NlsHunterApi;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     2.0.0
	 * @return    NlsHunterApi_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader()
	{
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     2.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version()
	{
		return $this->version;
	}

	/**
	 * Retrieve the search results for search results page
	 *
	 * @since     2.0.0
	 * @return    array    The search results.
	 */
	public function get_searchResults()
	{
		return $this->searchResultsUrl;
	}

	/**
	 * Retrieve the Job details for the current job ID.
	 *
	 * @since     2.0.0
	 * @return    array    The Job details for the current job ID.
	 */
	public function get_jobDetails()
	{
		return $this->jobDetails;
	}
}
