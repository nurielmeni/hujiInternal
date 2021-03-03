<?php
require_once 'Hunter/NlsHelper.php';
require_once ABSPATH . 'wp-content/plugins/NlsHunterApi/renderFunction.php';

/**
 * Description of class-NlsHunterApi-modules
 *
 * @author nurielmeni
 */
class NlsHunterApi_modules {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }
    
    /**
     * Handler for slider people shortcode
     */
    public function nlsRecruitProcess() {
        
        $args = [
            'numberposts' => -1, 
            'category_name' => 'recruit-process',
            'orderby' => 'date',
            'order' => 'ASC',
        ];

        $recruitProcessItems = get_posts( $args );

        ob_start();

        echo '<section id="recruit-process" class="recruit-process">';
        echo '<div class="recruit-process-wrapper content">';
        
        echo '<h2 class="content title-decoration anchor-fix">תהליך הגיוס</h2>';

        // render each people item
        foreach ($recruitProcessItems as $recruitProcessItem) {
            $image = get_the_post_thumbnail_url($recruitProcessItem->ID);
            echo render('recruitProcess', [
                'recruitProcessItem' => $recruitProcessItem,
                'image' => $image,
            ]);
        }

        echo '</div>';
        echo '</section>';
        
        return ob_get_clean();
    }

    /**
     * Handler for the Search Slug
     */
    public function nlsHunterSearch() {
        // Look to see if the search page was submited and get options
        $search = $this->model->getSearchOptions();
        
        $professionalFields = $this->model->get_professional_fields();
        $jobTypes = $this->model->get_jobTypes();
        $areas = $this->model->get_areas();

        $supplierId = $this->model->get_supplierId();

        // Get the url for the search result page, if not provided show error
        $searchResultsUrl = $this->model->getPageUrl(NlsHunterApi_Admin::NLS_SEARCH_RESULTS_PAGE);

        // Set message to user, no search result page was found
        if (!$searchResultsUrl) {
            $message = __('Search Results page was not provided (Hunter Plugin Admin).', 'NlsHunterApi');
            $subject = __('Missing Settings', 'NlsHunterApi');
            echo NlsHelper::addFlash($message, $subject);
        }
        
        /*
         *  Display The Search Form
         *  Required Variables: 
         *      $searchResultsUrl   
         *      $professionalFields
         *      $jobTypes
         */
        ob_start();

        include_once plugin_dir_path( __FILE__ ). '../public/partials/searchForm.php';
        include_once plugin_dir_path( __FILE__ ). '../public/partials/applyForJobs.php';

        return ob_get_clean();
    }

    // Search Results Slug
    public function nlsHunterSearchResults() {
        $search = $this->model->getSearchOptions();
        $id = is_array($search) && 
            key_exists('professionalFields', $search) && 
            is_array($search['professionalFields']) &&
            count($search['professionalFields']) > 0 ? 
            intval($search['professionalFields']['0']) : 
            0;
        
        $professionalFields = $this->model->get_professional_fields();
        $jobTypes = $this->model->get_jobTypes();
        $areas = $this->model->get_areas();
        
        $searchResultsTitle = $id > 0 && key_exists($id, $professionalFields) ? 
            $professionalFields[$id] : 
            __('Search Results', 'NlsHunterApi');

        $jobs = $this->model->getNlsHunterSearchResults();

        $supplierId = $this->model->get_supplierId();

        // Set the initial offset for the pager        
        $offset = $this->model->getPagerOffset();

        /**
         * @referer Array, the options for referer
         */
        $employmentStatus = $this->model->getEmploymentStatus();

        $searchPageUrl = $this->model->getPageUrl(NlsHunterApi_Admin::NLS_SEARCH_PAGE);
        $jobDetailsPageUrl = $this->model->getPageUrl(NlsHunterApi_Admin::NLS_JOB_DETAILS_PAGE);
        $searchResultsUrl = $this->model->getPageUrl(NlsHunterApi_Admin::NLS_SEARCH_RESULTS_PAGE);

        ob_start();

        include_once plugin_dir_path( __FILE__ ). '../public/partials/applyForJobs.php';

        $searchFormClass = "relative";
        include_once plugin_dir_path( __FILE__ ). '../public/partials/searchForm.php';

        echo '<div class="searc-results-wrapper">';
            include_once plugin_dir_path( __FILE__ ). '../public/partials/searchResults.php';
        echo '</div>';


        return ob_get_clean();
    }

    // Job details slug
    public function nlsHunterJobDetails() {
        // Getting the job details that were gotten on plugin init
        // Done to set the meta tags
        $referer = wp_get_referer();
        $searchResultsUrl = $this->model->getPageUrl(NlsHunterApi_Admin::NLS_SEARCH_RESULTS_PAGE);
        $jobDetailsPageUrl = $this->model->getPageUrl(NlsHunterApi_Admin::NLS_JOB_DETAILS_PAGE);

        $referer = strpos($referer, $searchResultsUrl) !== false ? $referer : home_url();

        $jobDetailsPage = get_post(get_option(NlsHunterApi_Admin::NLS_JOB_DETAILS_PAGE));
        $bannerImage = $jobDetailsPage ? get_the_post_thumbnail_url($jobDetailsPage->ID) : '';
         
        $jobDetails = $this->model->get_jobDetails();
        $jobResult = $jobDetails['jobResult'];
        $jobCode = $jobDetails['JobCode'];
        $job = count($jobResult) > 0 ? $jobResult[$jobCode] : [];
        $supplierId = $this->model->get_supplierId();
        $employmentStatus = $this->model->getEmploymentStatus();


        ob_start();

        if ($jobDetails) {
            include_once ABSPATH . 'wp-content/plugins/NlsHunterApi/public/partials/jobDetails.php';
            echo '<section class="apply-form content">';
            include_once ABSPATH . 'wp-content/plugins/NlsHunterApi/public/partials/applyForJobs.php';
            echo '</section>';
            include_once ABSPATH . 'wp-content/plugins/NlsHunterApi/public/partials/jobBottom.php';
        }

        return ob_get_clean();
    }
    
    public function nlsHunterSocial() {
        $nlsSocialIn = get_option(NlsHunterApi_Admin::NLS_SOCIAL_IN);
        $nlsSocialFace = get_option(NlsHunterApi_Admin::NLS_SOCIAL_FACE);
        $nlsSocialInsta = get_option(NlsHunterApi_Admin::NLS_SOCIAL_INSTA);
        $nlsSocialWeb = get_option(NlsHunterApi_Admin::NLS_SOCIAL_WEB);
        $nlsSocialMailTo = get_option(NlsHunterApi_Admin::NLS_SOCIAL_MAIL_TO);
        
        /*
         *  Display The Social Media module
         *  Required Variables: 
         *      $nlsSocialIn  
         *      $nlsSocialFace
         *      $nlsSocialMailTo
         */
        ob_start();

        include plugin_dir_path( __FILE__ ). '../public/partials/socialMedia.php';

        return ob_get_clean();
    }
}
