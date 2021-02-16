<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    NlsHunterApi
 * @subpackage NlsHunterApi/admin/partials
 */


?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div id="NlsHunterApi_settings" class="wrap">
<h1>Niloos HunterHRMS Settings Page</h1>

<form method="POST">
    <section id="email_settings">
        <h2 class="section-title">Email Settings</h2>
        <label for="nlsFromName">From Name</label>
        <input type="text" name="nlsFromName" id="nlsFromName" value="<?= $nlsFromName ?>">
        <br>

        <label for="nlsFromMail">From Mail</label>
        <input type="text" name="nlsFromMail" id="nlsFromMail" value="<?= $nlsFromMail ?>">
        <br>

        <label for="nlsToMail">To Mail</label>
        <input type="text" name="nlsToMail" id="nlsToMail" value="<?= $nlsToMail ?>">
        <br>

        <label for="nlsToMail">Bcc Mail (testing)</label>
        <input type="text" name="nlsBccMail" id="nlsBccMail" value="<?= $nlsBccMail ?>">
        <br>
    </section>    
    
    <section id="application_settings">
        <h2 class="section-title">Application Settings</h2>
        <label for="nlsNsoftSupplierId">Supplier ID</label>
        <input type="text" name="nlsNsoftSupplierId" id="nlsNsoftSupplierId" value="<?= $nlsNsoftSupplierId ?>">
        <br>

        <label for="nlsNsoftFreindSupplierId">Friend Supplier ID</label>
        <input type="text" name="nlsNsoftFreindSupplierId" id="nlsNsoftFreindSupplierId" value="<?= $nlsNsoftFreindSupplierId ?>">
        <br>

        <label for="nlsNsoftHotJobsId">Hot Jobs Supplier ID</label>
        <input type="text" name="nlsNsoftHotJobsId" id="nlsNsoftHotJobsId" value="<?= $nlsNsoftHotJobsId ?>">
        <br>
    </section>    

    <section id="api_service_settings">
        <h2 class="section-title">API Service Settings</h2>
        <label for="nlsDirectoryWsdlUrl">Directory WSDL</label>
        <input type="text" name="nlsDirectoryWsdlUrl" id="nlsDirectoryWsdlUrl" value="<?= $nlsDirectoryWsdlUrl ?>">
        <br>

        <label for="nlsCardsWsdlUrl">Cards WSDL</label>
        <input type="text" name="nlsCardsWsdlUrl" id="nlsCardsWsdlUrl" value="<?= $nlsCardsWsdlUrl ?>">
        <br>

        <label for="nlsSecurityWsdlUrl">Security WSDL</label>
        <input type="text" name="nlsSecurityWsdlUrl" id="nlsSecurityWsdlUrl" value="<?= $nlsSecurityWsdlUrl ?>">
        <br>

        <label for="nlsSearchWsdlUrl">Search WSDL</label>
        <input type="text" name="nlsSearchWsdlUrl" id="nlsSearchWsdlUrl" value="<?= $nlsSearchWsdlUrl ?>">
        <br>
    </section>    

    <section id="login_settings">
        <h2 class="section-title">Login Settings</h2>
        <label for="nlsConsumerKey">Consumer</label>
        <input type="text" name="nlsConsumerKey" id="nlsConsumerKey" value="<?= $nlsConsumerKey ?>">
        <br>

        <label for="nlsWebServiceDomain">Domain</label>
        <input type="text" name="nlsWebServiceDomain" id="nlsWebServiceDomain" value="<?= $nlsWebServiceDomain ?>">
        <br>

        <label for="nlsSecurityUsername">Username</label>
        <input type="text" name="nlsSecurityUsername" id="nlsSecurityUsername" value="<?= $nlsSecurityUsername ?>">
        <br>

        <label for="nlsSecurityPassword">Password</label>
        <input type="text" name="nlsSecurityPassword" id="nlsSecurityPassword" value="<?= $nlsSecurityPassword ?>">
        <br>
    </section>  

    <section id="hunter_page_settings">
        <h2 class="section-title">Hunter Page Settings</h2>
        <p>[Shortcodes]</p>
        <?= $this->adminSelectPage(NlsHunterApi_Admin::NLS_SEARCH_PAGE, $nlsSearchPage, 'Search Page') ?>
        <small>* The page must have the slug <i>[nls_hunter_search]</i></small>
        <br>
        <?= $this->adminSelectPage(NlsHunterApi_Admin::NLS_SEARCH_RESULTS_PAGE, $nlsSearchResultsPage, 'Search Results Page') ?>
        <small>* The page must have the slug <i>[nls_hunter_search_results]</i></small>
        <br>
        <?= $this->adminSelectPage(NlsHunterApi_Admin::NLS_JOB_DETAILS_PAGE, $nlsJobDetailsPage, 'Job Details Page') ?>
        <small>* The page must have the slug <i>[nls_hunter_job_details]</i></small>
        <br>
        <small>* Hunter hot jobs module <i>[nls_hunter_hot_jobs]</i></small>
        <br>
        <small>
            * Hunter Slider People<i>[nls_hunter_slider_people]</i>
            <p>Gets the data from posts of category 'slider-people'</p>
            <p>title, image, post excerpt, tags (the first)</p>
        </small>
        <small>
            * Hunter Category Galery<i>[nls_hunter_category_galery]</i>
            <p>Gets the data from posts of category 'תחומים - עמודה #'</p>
            <p>title, image, post excerpt - as the searchResults URL properties</p>
            <p>in the column it is ordered by the date</p>
        </small>
    </section>

    <section id="hunter_fields_settings">
        <h2 class="section-title">Hunter Fields Settings</h2>

        <label for="nlsFieldByLocation">By Location</label>
        <input type="checkbox" name="nlsFieldByLocation" id="nlsFieldByLocation" <?= $nlsFieldByLocation === 'true' ? 'checked' : '' ?> value="true">
        <br>

        <label for="nlsPagerPerPage">Pager Per Page Records</label>
        <input type="number" name="nlsPagerPerPage" id="nlsPagerPerPage" value=<?= $nlsPagerPerPage ?>>
        <br>

    </section>

    <section id="hunter_social_settings">
        <h2 class="section-title">Hunter Social Settings</h2>
        <label for="nlsSocialIn">Linked In</label>
        <input type="text" name="nlsSocialIn" id="nlsSocialIn" value="<?= $nlsSocialIn ?>">
        <br>

        <label for="nlsSocialFace">Facebook</label>
        <input type="text" name="nlsSocialFace" id="nlsSocialFace" value="<?= $nlsSocialFace ?>">
        <br>

        <label for="nlsSocialInsta">Instagram</label>
        <input type="text" name="nlsSocialInsta" id="nlsSocialInsta" value="<?= $nlsSocialInsta ?>">
        <br>

        <label for="nlsSocialWeb">web</label>
        <input type="text" name="nlsSocialWeb" id="nlsSocialWeb" value="<?= $nlsSocialWeb ?>">
        <br>

        <label for="nlsSocialMailTo">Mail To</label>
        <input type="text" name="nlsSocialMailTo" id="nlsSocialMailTo" value="<?= $nlsSocialMailTo ?>">
        <br>
    </section>

    <br>
    <input type="submit" value="Save" class="button button-primary button-large">
</form>
</div>
