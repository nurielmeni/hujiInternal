<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.1.0
 *
 * @package    NlsHunterApi
 * @subpackage NlsHunterApi/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    NlsHunterApi
 * @subpackage NlsHunterApi/admin
 * @author     Meni Nuriel <nurielmeni@gmail.com>
 */
class NlsHunterApi_Admin {
    const FROM_NAME = 'nlsFromName';
    const FROM_MAIL = 'nlsFromMail';
    const TO_MAIL = 'nlsToMail';
    const BCC_MAIL = 'nlsBccMail';
    const NSOFT_SUPPLIER_ID = 'nlsNsoftSupplierId';
    const NSOFT_FREIND_SUPPLIER_ID = 'nlsNsoftFreindSupplierId';
    const NSOFT_HOT_JOBS_ID = 'nlsNsoftHotJobsId';
    const DIRECTORY_WSDL_URL = 'nlsDirectoryWsdlUrl';
    const CARDS_WSDL_URL = 'nlsCardsWsdlUrl';
    const SECURITY_WSDL_URL = 'nlsSecurityWsdlUrl';
    const SEARCH_WSDL_URL = 'nlsSearchWsdlUrl';
    const NLS_CONSUMER_KEY = 'nlsConsumerKey';
    const NLS_WEB_SERVICE_DOMAIN = 'nlsWebServiceDomain';
    const NLS_SECURITY_USERNAME = 'nlsSecurityUsername';
    const NLS_SECURITY_PASSWORD = 'nlsSecurityPassword';
    const NLS_SEARCH_PAGE = 'nlsSearchPage';
    const NLS_SEARCH_RESULTS_PAGE = 'nlsSearchResultsPage';
    const NLS_JOB_DETAILS_PAGE = 'nlsJobDetailsPage';
    const NLS_PAGER_PER_PAGE = 'nlsPagerPerPage';
    const NLS_FIELD_BY_LOCATION = 'nlsFieldByLocation';
    const NLS_SOCIAL_IN = 'nlsSocialIn';
    const NLS_SOCIAL_FACE = 'nlsSocialFace';
    const NLS_SOCIAL_INSTA = 'nlsSocialInsta';
    const NLS_SOCIAL_WEB = 'nlsSocialWeb';
    const NLS_SOCIAL_MAIL_TO = 'nlsSocialMailTo';

    private $defaultValue;
        /**
	 * The ID of this plugin.
	 *
	 * @since    1.1.0
	 * @access   private
	 * @var      string    $NlsHunterApi    The ID of this plugin.
	 */
	private $nlsHunterApi;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.1.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.1.0
	 * @param      string    $NlsHunterApi       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $nlsHunterApi, $version ) {

        $this->nlsHunterApi = $nlsHunterApi;
        $this->version = $version;
        $this->defaultValue = [
            self::DIRECTORY_WSDL_URL => 'https://hunterdirectory.hunterhrms.com/DirectoryManagementService.svc?wsdl',
            self::CARDS_WSDL_URL => 'https://huntercards.hunterhrms.com/HunterCards.svc?wsdl',
            self::SECURITY_WSDL_URL => 'https://hunterdirectory.hunterhrms.com/SecurityService.svc?wsdl',
            self::SEARCH_WSDL_URL => 'https://huntersearchengine.hunterhrms.com/SearchEngineHunterService.svc?wsdl',
            self::NLS_PAGER_PER_PAGE => 9
        ];

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.1.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in NlsHunterApi_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The NlsHunterApi_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->nlsHunterApi, plugin_dir_url( __FILE__ ) . 'css/NlsHunterApi-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.1.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in NlsHunterApi_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The NlsHunterApi_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->nlsHunterApi, plugin_dir_url( __FILE__ ) . 'js/NlsHunterApi-admin.js', array( 'jquery' ), $this->version, false );

	}

    public function NlsHunterApi_plugin_menu() {
        add_options_page( 
            'HunterHRMS Options', 
            'HunterHRMS', 
            'manage_options', 
            'NlsHunterApi-unique-identifier', 
            array(
				$this,
				'NlsHunterApi_plugin_options'
			) 
        );
    }
    
    // Load the plugin admin page partial.
    public function NlsHunterApi_plugin_options() {
        if ( !current_user_can( 'manage_options' ) )  {
            wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
        }
        if ( isset($_POST) && count($_POST) > 0 ) {
            // Remove the auth key from previous settings
            update_option(NlsService::AUTH_KEY, null);
            update_option(self::NLS_FIELD_BY_LOCATION, null);
        }
        $nlsFromName = $this->getFieldValue(self::FROM_NAME);
        $nlsFromMail = $this->getFieldValue(self::FROM_MAIL);
        $nlsToMail = $this->getFieldValue(self::TO_MAIL);
        $nlsBccMail = $this->getFieldValue(self::BCC_MAIL);
        $nlsNsoftSupplierId = $this->getFieldValue(self::NSOFT_SUPPLIER_ID);
        $nlsNsoftFreindSupplierId = $this->getFieldValue(self::NSOFT_FREIND_SUPPLIER_ID);
        $nlsNsoftHotJobsId = $this->getFieldValue(self::NSOFT_HOT_JOBS_ID);
        $nlsDirectoryWsdlUrl = $this->getFieldValue(self::DIRECTORY_WSDL_URL);
        $nlsCardsWsdlUrl = $this->getFieldValue(self::CARDS_WSDL_URL);
        $nlsSecurityWsdlUrl = $this->getFieldValue(self::SECURITY_WSDL_URL);
        $nlsSearchWsdlUrl = $this->getFieldValue(self::SEARCH_WSDL_URL);
        $nlsConsumerKey = $this->getFieldValue(self::NLS_CONSUMER_KEY);
        $nlsWebServiceDomain = $this->getFieldValue(self::NLS_WEB_SERVICE_DOMAIN);
        $nlsSecurityUsername = $this->getFieldValue(self::NLS_SECURITY_USERNAME);
        $nlsSecurityPassword = $this->getFieldValue(self::NLS_SECURITY_PASSWORD);
        $nlsSearchPage = $this->getFieldValue(self::NLS_SEARCH_PAGE);
        $nlsSearchResultsPage = $this->getFieldValue(self::NLS_SEARCH_RESULTS_PAGE);
        $nlsJobDetailsPage = $this->getFieldValue(self::NLS_JOB_DETAILS_PAGE);
        $nlsFieldByLocation = $this->getFieldValue(self::NLS_FIELD_BY_LOCATION);
        $nlsPagerPerPage = $this->getFieldValue(self::NLS_PAGER_PER_PAGE);
        $nlsSocialIn = $this->getFieldValue(self::NLS_SOCIAL_IN);
        $nlsSocialFace = $this->getFieldValue(self::NLS_SOCIAL_FACE);
        $nlsSocialInsta = $this->getFieldValue(self::NLS_SOCIAL_INSTA);
        $nlsSocialWeb = $this->getFieldValue(self::NLS_SOCIAL_WEB);
        $nlsSocialMailTo = $this->getFieldValue(self::NLS_SOCIAL_MAIL_TO);
        
        
        require_once plugin_dir_path( __FILE__ ). 'partials/NlsHunterApi-admin-display.php';
    }
    
    private function getFieldValue($field) {
        if (isset($_POST[$field])) {
            $value = $_POST[$field];
            update_option($field, $value);
        }
        $value = get_option($field, key_exists($field, $this->defaultValue) ? $this->defaultValue[$field] : 'Not-Set');
        return $value;
    }    
    
    private function adminSelectPage($name, $value, $label) {
        $selectPage = '<label for="' . $name . '">' . $label . '</label>';
        $selectPage .= '<select name="' . $name . '">';
        $selectPage .=    '<option selected="selected" disabled="disabled" value="">';
        $selectPage .=    esc_attr(__($label)) . '</option>';
                $pages = get_pages();
                foreach ($pages as $page) {
                    $option = '<option value="' . $page->ID . '" ';
                    $option .= ( $page->ID == $value ) ? 'selected="selected"' : '';
                    $option .= '>';
                    $option .= $page->post_title;
                    $option .= '</option>';
                    $selectPage .= $option;
                }
        $selectPage .= '</select>';
        return $selectPage;
    }
}
