<?php
include_once ABSPATH . 'wp-content/plugins/NlsHunterApi/renderFunction.php';
include_once ABSPATH . 'wp-content/plugins/NlsHunterApi/includes/class-NlsHunterApi-model.php';
/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    NlsHunterApi
 * @subpackage NlsHunterApi/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    NlsHunterApi
 * @subpackage NlsHunterApi/public
 * @author     Meni Nuriel <nurielmeni@gmail.com>
 */
class NlsHunterApi_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $NlsHunterApi    The ID of this plugin.
	 */
	private $NlsHunterApi;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
    private $version;
    
    /** 
     * Show log messages
    */
    private $debug;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $NlsHunterApi       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $NlsHunterApi, $version ) {

		$this->NlsHunterApi = $NlsHunterApi;
		$this->version = $version;
        $this->debug = WP_DEBUG;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
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

		wp_enqueue_style( 'nlsHunterApi-public', plugin_dir_url( __FILE__ ) . 'css/nlsHunterApi-public.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'nlsHunterApi-public-responsive', plugin_dir_url( __FILE__ ) . 'css/nlsHunterApi-public-responsive.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'sumo-select-css', plugin_dir_url( __FILE__ ) . 'css/sumoselect.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'sumo-select-css-rtl', plugin_dir_url( __FILE__ ) . 'css/sumoselect-rtl.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'recruit-process', plugin_dir_url( __FILE__ ) . 'css/recruit-process.css', array(), $this->version, 'all' );
		//wp_enqueue_style( 'font-face-open-sans-heb', plugin_dir_url( __FILE__ ) . 'css/fonts.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'front-page-loader', plugin_dir_url( __FILE__ ) . 'css/loader.css', array(), $this->version, 'all' );
	}

	public function add_code_on_body_open() {
        include_once plugin_dir_path( __FILE__ ). '../public/partials/popup.php';
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
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

		wp_enqueue_script( 'sumo-select-js', plugin_dir_url( __FILE__ ) . 'js/jquery.sumoselect.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'nls-form-validation', plugin_dir_url( __FILE__ ) . 'js/NlsHunterForm.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->NlsHunterApi, plugin_dir_url( __FILE__ ) . 'js/NlsHunterApi-public.js', array( 'jquery' ), $this->version, false );
        
        /** Form Validators Script **/
        // included in taas object defined in   NlsHunterApi-public.js
        //wp_enqueue_script('form-validators-script', plugin_dir_url( __FILE__ ) . 'js/formValidators.js' );

        /** The Google API Loader script. **/
        //wp_enqueue_script('google-api', 'https://apis.google.com/js/api.js?onload=onApiLoad' );
        //wp_enqueue_script('google-drive-file-picker', plugin_dir_url( __FILE__ ) . 'js/googleFilePicker.js' );

        /** The Dropbox API Script **/
        //wp_enqueue_script( 'dropbox-api', 'https://www.dropbox.com/static/api/2/dropins.js' );
        //wp_enqueue_script('dropbox-file-chooser', plugin_dir_url( __FILE__ ) . 'js/dropboxFileChooser.js' );
        
        // enqueue and localise scripts
        //wp_enqueue_script( 'search-results-pager-ajax-handle', plugin_dir_url( __FILE__ ) . 'js/searchResultsPagerAjax.js', array( 'jquery' ), $this->version, false );
        //wp_localize_script( 'search-results-pager-ajax-handle', 'search_results_pager_script', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

        // enqueue and localise scripts for handling Ajax Submit CV
        // Don't forget to add the action (apply_cv_function) defined in js
        // Don't forget to add the action (send_ducument_function) defined in js
        wp_enqueue_script( 'apply-cv-ajax-handle', plugin_dir_url( __FILE__ ) . 'js/NlsHunterForm.js', [ 'jquery' ], $this->version, false );
        wp_localize_script( 'apply-cv-ajax-handle', 'apply_cv_script', [ 'applyajaxurl' => admin_url( 'admin-ajax.php' ) ] );        

        //wp_localize_script( 'send-ducument-ajax-handle', 'send_ducument_script', [ 'applyajaxurl' => admin_url( 'admin-ajax.php' ) ] );        


        // enqueue and localise scripts for handling Polyfill for IE support UrlSearchParams
        //wp_enqueue_script( 'apply-cv-ajax-handle', plugin_dir_url( __FILE__ ) . 'js/url-search-params.js', [ 'jquery' ], $this->version, false );
    }
    
    /*
     * Return the pager data to the search result module
     */
    public function search_results_pager_function() {
        $modules = new NlsHunterApi_modules();
        $selectedOptions = key_exists('SelectedOptions', $_POST) ? $_POST['SelectedOptions'] : null;
        $offset = key_exists('offset', $_POST) ? $_POST['offset'] : 0;
        $countPerPage = NlsHunterApi_modules::NLS_SEARCH_COUNT_PER_PAGE;
        
        $modules->nlsHunterSearchResultsAjax($selectedOptions, $offset, $countPerPage);
        // Don't forget to stop execution afterward.
        wp_die();    
    }

    /**
     * Helper function to write log messages
     */
    public function writeLog($message, $level = 'debug') {
        if (!$this->debug) return;
        
        $logFile = NLS_PLUGIN_PATH . 'logs/default.log';

        $data = date("Ymd") . ' ' . $level . ' ' . $message;
        file_put_contents($logFile, $data, FILE_APPEND);
    }

    public function getSubmitedFile($name, $full = false) {
        $file = [];
        $fileName = isset($_FILES[$name]) ? $_FILES[$name]['name'] : "";
        if (!is_array($fileName) || empty($fileName)) return null;
        $count = count($fileName);

        for($i = 0; $i < $count; $i++) {
            if ($_FILES[$name]['error'][$i]) {
                $response = ['sent' => 0, 'html' => $this->sentError(__('Error on uploading the file', 'NlsHunterApi'))];
                wp_send_json($response);
                wp_die();
            }

            $file[$i]['ext'] = pathinfo($fileName[$i], PATHINFO_EXTENSION);
            $file[$i]['name'] = preg_replace('/\.' . $file[$i]['ext'] . '$/', '', $fileName[$i]);
            $this->writeLog('getSubmitedFile: naem:ext' . $file[$i]['name'] . ':' . $file[$i]['ext']);
            $tmpFileName = isset($_FILES[$name]) ? $_FILES[$name]['tmp_name'][$i] : "";

            if (strlen($fileName[$i]) > 0) {
                $file[$i]['path'] = $this->generateTempFile($file[$i]['ext'], $file[$i]['name']);
                move_uploaded_file( $tmpFileName, $file[$i]['path']);
                $this->writeLog('File('.$i.'): ' . $name . ': ' . $file[$i]['path']);
                
            }
        }

        return $file;
    }

    /**
     * Uploads user document to the service
     */
    public function send_document_function() {
        // 1. Get the form data
        $email = isset($_POST['email']) ? $_POST['email'] : null;
        $cell = isset($_POST['cell']) ? $_POST['cell'] : null;

        // 2. Get addFile (If the file could not be loaded) get an array with full data (name, ext, path)
        $addFiles = $this->getSubmitedFile('addFile');
        if (!$addFiles || empty($addFiles)) {
            $response = ['status' => 'Error on uloading the file', 'html' => $this->responseHtml(
                __('Error on uploading the file', 'NlsHunterApi'),
                __('It might be for corrupted or to large file.', 'NlsHunterApi')
            )];
            wp_send_json($response);
            return;
        }

        // 3. Find the first card by the email or phone
        $model = new NlsHunterApi_model();
        $model->initCardService();
        $card = $model->getCardByEmailOrCell($email, $cell);
        $cardId = count($card) > 0 && key_exists('CardId', $card[0]) ? $card[0]['CardId'] : null;
        if (!$cardId) {
            $response = ['status' => 'Not found', 'html' => $this->responseHtml(
                __('Card not found', 'NlsHunterApi'),
                __('Could not find a card with the submited data, check your details', 'NlsHunterApi')
            )];
            wp_send_json($response);
            return;
        }

        $filesDetails = '';
        // 4. Upload the file to card
        foreach($addFiles as $addFile){
            try {
                $upload = $model->insertNewFile($cardId, $addFile);
            } catch(\Exception $e) {
                if (is_array($addFile) && key_exists('path', $addFile)) unlink($addFile['path']);
                $response = [
                    'status' => 'Not found', 
                    'html' => $this->responseHtml(
                        __('File upload error', 'NlsHunterApi'),
                        __('Could not upload the file to the card', 'NlsHunterApi')
                    ),
                    'error' => $e->getMessage()
                ];
                wp_send_json($response);
                return null;
            }

            // 5. remoeve the tmp file
            if ($addFile) unlink($addFile['path']);
            $filesDetails .= '<br>' . $addFile['name'] . '.' . $addFile['ext'];
        }    

        $response = ['status' => 'Success', 'html' => $this->responseHtml(
            __('Success', 'NlsHunterApi'),
            __('Your file: ', 'NlsHunterApi') . $filesDetails,
            __('Uploaded successfuly', 'NlsHunterApi')
        )];
        wp_send_json($response);
        return;
    }

    /*
     * Return the pager data to the search result module
     */
    public function apply_cv_function() {
        // Get the selected job ids to submit for
        $jobids = isset($_POST['jobIds']) ? explode(',', $_POST['jobIds']) : [];
        is_array($jobids) ?: $jobids = array($jobids);

        // Get the form fields
        $fields['firstName'] = ['label' => __('First Name', 'NlsHunterApi'), 'value' => isset($_POST['firstName']) ? $_POST['firstName'] : ""];
        $fields['lastName'] = ['label' => __('Last Name', 'NlsHunterApi'), 'value' => isset($_POST['lastName']) ? $_POST['lastName'] : ""];
        $fields['federalId'] = ['label' => __('ID', 'NlsHunterApi'), 'value' => isset($_POST['federalId']) ? $_POST['federalId'] : ""];
        $fields['email'] = ['label' => __('Email', 'NlsHunterApi'), 'value' => isset($_POST['email']) ? $_POST['email'] : ""];
        $fields['cell'] = ['label' => __('Cell', 'NlsHunterApi'), 'value' => isset($_POST['cell']) ? $_POST['cell'] : ""];
        $fields['workedBefore'] = ['label' => __('Worked before', 'NlsHunterApi'), 'value' => isset($_POST['workedBefore']) ? $_POST['workedBefore'] : ""];
        $fields['relative'] = ['label' => __('Relatives in the company?', 'NlsHunterApi'), 'value' => isset($_POST['relative']) ? $_POST['relative'] : ""];
        $fields['relativeName'] = ['label' => __('Relative Name', 'NlsHunterApi'), 'value' => isset($_POST['relativeName']) ? $_POST['relativeName'] : ""];
        $fields['relation'] = ['label' => __('Relation', 'NlsHunterApi'), 'value' => isset($_POST['relation']) ? $_POST['relation'] : ""];
        $fields['requiredCertificates'] = ['label' => __('Required Certificates', 'NlsHunterApi'), 'value' => isset($_POST['requiredCertificates']) ? $_POST['requiredCertificates'] : ""];
        $fields['referer'] = ['label' => __('How did you get to us', 'NlsHunterApi'), 'value' => isset($_POST['referer']) ? $_POST['referer'] : ""];
        $fields['refererName'] = ['label' => __('Referer Name', 'NlsHunterApi'), 'value' => isset($_POST['refererName']) ? $_POST['refererName'] : ""];
        $fields['sid'] = ['label' => __('Supplier Id', 'NlsHunterApi'), 'value' => isset($_POST['sid']) ? $_POST['sid'] : ""];


        $attachedFiles = [];

        // CV FILE
        $tmpCvFile = $this->getSubmitedFile('cvFile');
        if ($tmpCvFile !== null && is_array($tmpCvFile)) {
            foreach($tmpCvFile as $f) {
                array_push($attachedFiles, $f['path']);
            }
        }

        // OTHER FILE
        $tmpOtherFile = $this->getSubmitedFile('otherFile');
        if ($tmpOtherFile !== null && is_array($tmpCvFile)) {
            foreach($tmpOtherFile as $f) {
                array_push($attachedFiles, $f['path']);
            }
        }

        // NCAI Files
        $ncaiFile = $this->createNCAI($fields);
        array_push($attachedFiles, $ncaiFile);

        $this->writeLog("JobIds: " . print_r($jobids, true) . ", Fields: " . print_r($fields, true) . ", File Names: " . print_r($attachedFiles, true));

        $sent = 0;

        // Send the email foreach Job
        if (count($jobids) > 0) {
            foreach ($jobids as $jobid) {
                $sent += $this->sendHtmlMail($jobid, $attachedFiles, $fields) ? 1 : 0;
                if (count($attachedFiles) > 2) $attachedFiles = [$tmpCvFile, $ncaiFile]; 
            }
        } else { // Send General CV 
            $sent += $this->sendHtmlMail(null, $tmpCvFile, $fields, __('CV without a Job', 'NlsHunterApi')) ? 1 : 0;
        }
        
        // Remove the temp file from the Upload directory
        if ($tmpCvFile) unlink($tmpCvFile);
        if ($ncaiFile) unlink($ncaiFile);
        
        $response = ['sent' => $sent, 'html' => ($sent > 0 ? $this->sentSuccess($sent) : $this->sentError())];
        wp_send_json($response);
    }
    
    private function driveFileContent($id, $oauthToken) {
        $getUrl = 'https://www.googleapis.com/drive/v2/files/' . $id . '?alt=media';
        $authHeader = 'Authorization: Bearer ' . $oauthToken;                                
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $getUrl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array($authHeader));
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        $data = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);
        
        return $data;
    }    
    private function generateTempFile($fileExt, $fileName = '') {
        $this->writeLog("\ngenerateTempFile: Ext, Name: $fileExt, $fileName");
        $tmpFolder = 'nlsTempFiles';
        $upload_dir   = wp_upload_dir();

        if ( ! empty( $upload_dir['basedir'] ) ) {
            $cv_dirname = $upload_dir['basedir'].'/'.$tmpFolder;
                if ( ! file_exists( $cv_dirname ) ) {
                wp_mkdir_p( $cv_dirname );
            }
        } 

        if ($fileExt === 'ncai') {
            return $cv_dirname . DIRECTORY_SEPARATOR . 'NlsCvAnalysisInfo.'. $fileExt;
        }

        if (!empty($fileName)) {
            $filePath = $cv_dirname . DIRECTORY_SEPARATOR . $fileName . '.' . $fileExt;
            $this->writeLog("\nFile path: $filePath");
            return $filePath;
        }
        return $cv_dirname . DIRECTORY_SEPARATOR . 'CV_FILE_' . mt_rand(100, 999) . '.' . $fileExt;
    }

    private function createNCAI($fields) {
        //create xml file
        $xml_obj = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" standalone="yes"?><NiloosoftCvAnalysisInfo xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"></NiloosoftCvAnalysisInfo>');

        $applyingPerson = $xml_obj->addChild('ApplyingPerson');
        $applyingPerson->addChild('EntityLocalName', $fields['firstName']['value'] . ' ' . $fields['lastName']['value']);
        $applyingPerson->addChild('FederalId', $fields['federalId']['value']);
        //$applyingPerson->addChild('Email', $fields['email']['value']);
        //$applyingPerson->addChild('Phones')->addChild('PhoneInfo')->addChild('PhoneNumber', $fields['cell']['value']);
        $applyingPerson->addChild('SupplierId', $fields['sid']['value']);

        // $CardProfessinalFields = $applyingPerson->addChild('CardProfessinalFields');
        // foreach ($applicant_profession as $profession){
        //     $CardProfessinalField = $CardProfessinalFields->addChild('CardProfessinalField')->addChild('CategoryId', $fields['strongSide']['value']);
        // }                                

        $applicant_notes = __('Applicant form data: ', 'NlsHunterApi')."\r\n";
        foreach($fields as $key => $field) {
            if (empty($field['value'])) continue;
            $applicant_notes .= $field['label'] . ': ' . __($field['value'], 'NlsHunterApi') . "\r\n";
        }

        $xml_obj->addChild('Notes', $applicant_notes);
        $xml_obj->SupplierId = $fields['sid']['value'];
        
        $ncaiFile = $this->generateTempFile('ncai');
        $xml_obj->asXML($ncaiFile);
        return $ncaiFile;
    }

    public function sendHtmlMail($jobid, $files, $fields, $msg = '') {
        $to = get_option(NlsHunterApi_Admin::TO_MAIL);
        $bcc = get_option(NlsHunterApi_Admin::BCC_MAIL);
        $headers = array(
            'Content-Type: text/html; charset=UTF-8',
            'bcc: ' . $bcc
        );
        $subject = __('CV Applied from Jobs Site', 'NlsHunterApi') . ': ';
        $subject .= $jobid ? ( 'Job Code: ' . "$jobid" ) : $msg;
        
        $attachments = $files ?: [];
        
        $body = render('mailApply', [
            'fields' => $fields
        ]);

        // Add image to the mail
        $file = wp_upload_dir()['basedir'] . '/logo@512.png'; //phpmailer will load this file
        $uid = 'logo@512'; //will map it to this UID
        $name = 'logo@512.png'; //this will be the file name for the attachment

        global $phpmailer;
        add_action( 'phpmailer_init', function(&$phpmailer)use($file,$uid,$name){
            $phpmailer->SMTPKeepAlive = true;
            $phpmailer->AddEmbeddedImage($file, $uid, $name);
        });

        add_filter( 'wp_mail_from', function( $email ) {
            return get_option(NlsHunterApi_Admin::FROM_MAIL);
        });
        add_filter( 'wp_mail_from_name', function( $name ) {
            return get_option(NlsHunterApi_Admin::FROM_NAME);
        });

        $result =  wp_mail($to, $subject, $body, $headers, $attachments);
        $this->writeLog("\nMail Result: $result");

        return $result;
    }
    
    private function sentSuccess() {
        //$html = '  <h2>' . __('Send cv', 'NlsHunterApi') . '</h2><br>';
        $html = ' <h3>' . __('Thenk you for applying, the form submited successfully!', 'NlsHunterApi') . '</h3>';
        //$html .= ' <a href="#" class="back-step"><i class="fa fa-long-arrow-right" aria-hidden="true"></i>' . __('Back', 'NlsHunterApi') . '  </a>';
        
        return $html;
    }

    private function sentError() {
        $html = '  <h2>' . __('Error occured', 'NlsHunterApi') . '</h2><br>';
        $html .= ' <p>' . __('The cv could not be sent successfully!', 'NlsHunterApi') . '</p>';
        //$html .= ' <a href="#" class="back-step"><i class="fa fa-long-arrow-right" aria-hidden="true"></i>' . __('Back', 'NlsHunterApi') . '  </a>';
                
        return $html;
    }

    private function responseHtml($title = '', $msg = '', $footer = '') {
        if (!is_array($msg)) {
            $msg = array($msg);
        }
        $html = '<div style="padding: 0.5rem 1rem;"><h2>' . $title . '</h2><br>';
        foreach($msg as $line) {
            $html .= '<p>' . $line . '</p>';
        }
        $html .= ' <p>' . $footer . '</p></div>';
                
        return $html;
    }

    public function configure_smtp( $phpmailer ){
        $sendgridApiKey = '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';
        
        $phpmailer->isSMTP(); //switch to smtp
        $phpmailer->Host = 'smtp.sendgrid.net';
        //$phpmailer->Host = 'mailsrv01.niloosoft.com';
        $phpmailer->SMTPAuth = true;
        //$phpmailer->Port = 25;
        $phpmailer->Port = 587;
        //$phpmailer->Username = 'idc@hunterhrms.com';
        $phpmailer->Username = 'apikey';
        //$phpmailer->Password = 'Pass2015!';
        $phpmailer->Password = $sendgridApiKey;
        $phpmailer->SMTPSecure = false;
        
    }
}
