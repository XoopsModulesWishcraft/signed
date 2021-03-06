<?php
/**
 * Chronolabs Digital Signature Generation & API Services (Psuedo-legal correct binding measure)
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       Chronolabs Cooperative http://labs.coop
 * @license			General Software Licence (http://labs.coop/briefs/legal/general-software-license/10,3.html)
 * @license			End User License (http://labs.coop/briefs/legal/end-user-license/11,3.html)
 * @license			Privacy and Mooching Policy (http://labs.coop/briefs/legal/privacy-and-mooching-policy/22,3.html)
 * @license			General Public Licence 3 (http://labs.coop/briefs/legal/general-public-licence/13,3.html)
 * @category		signed
 * @since			2.1.9
 * @version			2.2.0
 * @author			Simon Antony Roberts (Aus Passport: M8747409) <wishcraft@users.sourceforge.net>
 * @author          Simon Antony Roberts (Aus Passport: M8747409) <wishcraft@users.sourceforge.net>
 * @subpackage		language
 * @description		Digital Signature Generation & API Services (Psuedo-legal correct binding measure)
 * @link			Farming Digital Fingerprint Signatures: https://signed.ringwould.com.au
 * @link			Heavy Hash-info Digital Fingerprint Signature: http://signed.hempembassy.net
 * @link			XOOPS SVN: https://sourceforge.net/p/xoops/svn/HEAD/tree/XoopsModules/signed/
 * @see				Release Article: http://cipher.labs.coop/portfolio/signed-identification-validations-and-signer-for-xoops/
 * @filesource
 *
 */

	// API Help Language Constants
	define('_CONTENT_API_FUNCTIONS', '%s API Functions');
	define('_CONTENT_API_FIELDS', '%s API Fields');
	define('_CONTENT_API_PATH', 'To use the %s API functions the API works with a typical API REST system with either form POST/GET variables, the URL for the signing functions on the API is:~ <strong>%s</strong>');
	define('_CONTENT_API_TITLE', 'Digital Self Signed API Version %s');
	define('_CONTENT_API_DESCRIPTION', 'Welcome to the Digital Signature API, this instruction manual is how to use the API to Sign and Verify with Digital Signatures! All Fields are specified in you a-typical JSON String!');
	define('_CONTENT_API_SIGNING', 'Signing');
	define('_CONTENT_API_SIGNING_EXTRA_TITLE', 'The follow fields are not required and extra if you want to add them in to the polling of the signing API function, they can be included in any way and not empty:~');
	define('_CONTENT_API_SIGNING_EXTRA_FIELD', '{"polling-unique-id":"your-api-unique-id-for-this-poll:string","doctitle":"your-document-title:string"}');
	
	define('_CONTENT_API_SIGNING_REQUIRED_TITLE', 'The required fields to use the signing API function are the following, they must be included and not empty:~');
	define('_CONTENT_API_SIGNING_REQUIRED_FIELD', '{"docid":"your-documents-unique-session-id:string","doctitle":"your-document-title:string"}');
	define('_CONTENT_API_SIGNING_SEMI_TITLE', 'Class one of the identity fields for signing API function are the following if you are only using identity class one, you only need two or more of these if you are only using this basis to identify with class one, any less than two will flag an error:~');
	define('_CONTENT_API_SIGNING_SEMI_FIELD', ' {"serial-number":"serial-number-from-signature-xml:string","code":"signature-code-from-email:string","certificate":"signature-certificate-from-email:string"}');
	define('_CONTENT_API_SIGNING_PART_TITLE', 'Class two of the  identity fields you can use with one of class one and one of these fields for signing API function as class two, you can only use these if you specify one of the previously mention fields as in: serial-number, code, certificate. These fields are dynamic they allow you to enter one of any of that field type recorded in the signature, you need one of these in identity class two and one from identity class one:~');
	define('_CONTENT_API_SIGNING_PART_FIELD', ' {"any-name":"personal-or-entity-name:string","any-email":"any-email-in-signature:string","any-date":"dob-or-dor-in-signature:yyyy-mm-dd"}');
	
	define('_CONTENT_API_SIGNING_CALLBACK_TITLE', 'These fields are for signing API callback functions, you will need to specify all the fields if your going to use it or obmit it if your system doesn\'t require notice of expired signature or updates to identification:~');
	define('_CONTENT_API_SIGNING_CALLBACK_FIELD', ' {"callback-url":"your-url-for-the-api-to-call:string","signature-package-field":"field-for-the-api-to-put-signature-package-in:string","doc-identity-field":"field-for-the-api-to-put-document-identity-in","signature-updated-field":"field-for-the-api-to-put-updated-boolean-flag-in:string","signature-expiry-field":"field-for-the-api-to-put-expired-boolean-flag-in:string"}');
	define('_CONTENT_API_ENSIGNMENT', 'Ensignment Verification');
	define('_CONTENT_API_ENSIGNMENT_REQUIRED_TITLE', 'The required fields to use the Ensignment Verification API function are the following, they must be included and not empty:~');
	define('_CONTENT_API_ENSIGNMENT_REQUIRED_FIELD', '{"docid":"your-documents-unique-session-id:string","verification-key":"your-signature-verification-key:string"}');
	define('_CONTENT_API_VERIFICATION', 'Contact Verification');
	define('_CONTENT_API_VERIFICATION_REQUIRED_TITLE', 'Class one of the identity fields for contact verification API function are the following, you only need two or more of these, any less than two will flag an error:~');
	define('_CONTENT_API_VERIFICATION_REQUIRED_FIELD', '{"serial-number":"serial-number-from-signature-xml:string","code":"signature-code-from-email:string","certificate":"signature-certificate-from-email:string"}');
	define('_CONTENT_API_VERIFICATION_PART_TITLE', 'Class two of the identity fields you can use with one of class one and one of these fields for contact verification API function as class two, you can only use these if you specify one of the previously mention fields as in: serial-number, code, certificate. These fields are dynamic they allow you to enter one of any of that field type recorded in the signature, you need one of these in identity class two and one from identity class one:~');
	define('_CONTENT_API_VERIFICATION_PART_FIELD', ' {"any-name":"personal-or-entity-name:string","any-email":"any-email-in-signature:string","any-date":"dob-or-dor-in-signature:yyyy-mm-dd"}');
	define('_CONTENT_API_NONE_REQUIRED_TITLE', 'Their are no required fields for %s API function.');
	define('_CONTENT_API_BANNED', 'Banned IP & Hostname Addresses');
	define('_CONTENT_API_SITE_SERVICES', 'System Site Services');
	define('_CONTENT_API_LANGUAGES', 'System Languages');
	define('_CONTENT_API_CLASSES', 'System Classes');
	define('_CONTENT_API_FIELD_DESCRIPTION', 'System Field Descriptions');
	define('_CONTENT_API_FIELD_ENUMERATION', 'System Field Enumerations');
	define('_CONTENT_API_SYSFIELDS', 'System Fields');
	define('_CONTENT_API_FIELD_TYPE', 'System Field Types');
	define('_CONTENT_API_IDENTIFICATION', 'System Identification');
	define('_CONTENT_API_FIELD_PROMPT', 'System Field Prompt');
	define('_CONTENT_API_PROVIDERS', 'System Providers');
	define('_CONTENT_API_SIGNATURE_TYPES', 'System Signature Types');
	define('_CONTENT_API_FIELD_VALIDATION', 'System Field Validations');
	define('_CONTENT_API_PROCESSES', 'System Processes Definitions');
	define('_CONTENT_API_LANGAUGE_FILES', 'System Language Files Definitions');
	define('_CONTENT_API_STATES', 'Supports for Signature Changes Requests');
	define('_CONTENT_API_FUNCTION_SUPPORTS', 'System Supports for %s Requests');
	define('_CONTENT_API_FUNCTION_REQUIRES', 'The next required fields for <strong>%s API function</strong> are the following, you only need two or more of these, any less than two will flag an error:~');
	define('_CONTENT_API_FUNCTION_FIELD', '{"language":"language-path-from-api-call"}');
	define('_CONTENT_API_REQUESTS', 'Signature Data or Image Update Requests');
	define('_CONTENT_API_REQUESTS_REQUIRED_TITLE', 'The required fields to use the Signature Data or Image Update Requests API function are the following, they must be included and not empty:~');
	define('_CONTENT_API_REQUESTS_REQUIRED_FIELD', '{"request-code":"your-request-code-from-api-states:string","fields":["supported-field-name-one","supported-field-name-two","supported-field-name-etc"],"type-key":"identification-or-signature-type:string"}');
	define('_CONTENT_API_REQUESTS_SEMI_TITLE', 'Class one of the identity fields for Signature Data or Image Update Requests API function are the following if you are only using identity class one, you only need two or more of these if you are only using this basis to identify with class one, any less than two will flag an error:~');
	define('_CONTENT_API_REQUESTS_SEMI_FIELD', ' {"serial-number":"serial-number-from-signature-xml:string","code":"signature-code-from-email:string","certificate":"signature-certificate-from-email:string"}');
	define('_CONTENT_API_REQUESTS_PART_TITLE', 'Class two of the identity fields you can use with one of class one and one of these fields for for Signature Data or Image Update Requests API function as class two, you can only use these if you specify one of the previously mention fields as in: serial-number, code, certificate. These fields are dynamic they allow you to enter one of any of that field type recorded in the signature, you need one of these in identity class two and one from identity class one:~');
	define('_CONTENT_API_REQUESTS_PART_FIELD', ' {"any-name":"personal-or-entity-name:string","any-email":"any-email-in-signature:string","any-date":"dob-or-dor-in-signature:yyyy-mm-dd"}');
	define('_CONTENT_API_REQUESTS_CALLBACK_TITLE', 'These fields are for Signature Data or Image Update Requests API callback functions, you will need to specify all the fields if your going to use it or obmit it if your system doesn\'t require notice of expired signature or updates to identification:~');
	define('_CONTENT_API_REQUESTS_CALLBACK_FIELD', '{"callback-url":"your-url-for-the-api-to-call:string","signature-package-field":"field-for-the-api-to-put-signature-package-in:string","request-rejected-field":"field-for-the-api-to-put-if-request-for-data-update-been-rejected:boolean","signature-updated-field":"field-for-the-api-to-put-updated-boolean-flag-in:string"}');
	
	// Functional Pages Language Constants
	define('_CONTENT_BUTTON_NEXT', 'Next Step -->');
	define('_CONTENT_BUTTON_RESET', 'Reset (Then Back to Start)');

	define('_CONTENT_UPDATE_IDENTIFICATION_P1', 'Fill out this form for identification type:~ <strong>%s</strong>, only!');
	define('_CONTENT_UPDATE_IDENTIFICATION_H1', '%s Personal Identification Update Required');
	define('_CONTENT_UPDATE_IDENTIFICATION_PT', '%s Identification Update');

	define('_CONTENT_HELP_PERSONAL_INTRO_P1', 'The next series of forms will create a Personal and Individuals Digital Signature, outlined below is the information you should get ready for yourself before you click to the next option!');
	define('_CONTENT_HELP_PERSONAL_INTRO_P2', 'The following data will be required for the Personal Signature the following from your personal information:~');
	define('_CONTENT_HELP_PERSONAL_INTRO_P3', 'The scanned images of your personal identification for the Personal Signature the following will be required, you will have to have 100 points of Identification and on the next page you will specify which ones you will be giving, the following identification types are supported:~');
	define('_CONTENT_HELP_PERSONAL_INTRO_P4', 'You have to specify in years and months how long you want this Digital Signature to validate for (If you set both to 0 this is forever):~');
	define('_CONTENT_HELP_PERSONAL_INTRO_P5', 'Your Identifications will be watermarked on the original before shrinking, which looks like:~');
	define('_CONTENT_HELP_PERSONAL_INTRO_LIA', '%s - %s');
	define('_CONTENT_HELP_PERSONAL_INTRO_LIB', '%s - <em>Points Awarded for Using: <strong>%s</strong></em>');
	define('_CONTENT_HELP_PERSONAL_INTRO_H1A', 'Personal Information Required');
	define('_CONTENT_HELP_PERSONAL_INTRO_H1B', 'Scanned Identification Required');
	define('_CONTENT_HELP_PERSONAL_INTRO_H1C', 'Time this signature is active for');
	define('_CONTENT_HELP_PERSONAL_INTRO_H1D', 'Select your signature class');
	define('_CONTENT_HELP_PERSONAL_INTRO_PT', 'Introduction');
	
	define('_CONTENT_HELP_PERSONAL_FINISH_PT', 'Finished');
	define('_CONTENT_HELP_PERSONAL_FINISH_P1', 'You have <em>finished making your Digital Signature</em>, Congradulations! Below is a list of the resources that will have to be verified, these are typically email addresses and when they are you will be emailed your Digital Signature.');
	define('_CONTENT_HELP_PERSONAL_FINISH_H1A', 'Emails to be verified');
	define('_CONTENT_HELP_PERSONAL_FINISH_H1B', 'Mobile Phones to be verified');
	define('_CONTENT_HELP_PERSONAL_FINISH_LIA', '%s <strong>%s</strong>');
	define('_CONTENT_HELP_PERSONAL_FINISH_LIB', '+%s <strong>Verification SMS Sent</strong>');
	define('_CONTENT_HELP_PERSONAL_STATE_1A', 'Emails to be verified');
	define('_CONTENT_HELP_PERSONAL_STATE_1B', "Not Done");
	
	define('_CONTENT_HELP_ENTITY_INTRO_P1', 'The next series of forms will create a Digital Signature for a Business, Government or Military department or facility, outlined below is the information you should get ready for yourself before you click to the next option!');
	define('_CONTENT_HELP_ENTITY_INTRO_P2', 'The following data will be required for the Personal Data will be required for a Business, Government or Military department or facility signature:~');
	define('_CONTENT_HELP_ENTITY_INTRO_P3', 'The scanned images of your personal identification ffor a Business, Government or Military department or facility Signature the following will be required, you will have to have 100 points of Identification and on the next page you will specify which ones you will be giving, the following identification types are supported:~');
	define('_CONTENT_HELP_ENTITY_INTRO_P4', 'You have to specify in years and months how long you want this Digital Signature to validate for (If you set both to 0 this is forever):~');
	define('_CONTENT_HELP_ENTITY_INTRO_P5', 'The following data will be required for the Business, Government or Military department or facility:~');
	define('_CONTENT_HELP_ENTITY_INTRO_P6', 'You have to specify in years and months how long you want this Digital Signature to validate for (If you set both to 0 this is forever):~');
	define('_CONTENT_HELP_ENTITY_INTRO_P7', 'Your Identifications will be watermarked on the original before shrinking, which looks like:~');
	define('_CONTENT_HELP_ENTITY_INTRO_LIA', '%s - %s');
	define('_CONTENT_HELP_ENTITY_INTRO_LIB', '%s - <em>Points Awarded for Using: <strong>%s</strong></em>');
	define('_CONTENT_HELP_ENTITY_INTRO_LIC', '%s - %s');
	define('_CONTENT_HELP_ENTITY_INTRO_H1A', 'Personal Information Required');
	define('_CONTENT_HELP_ENTITY_INTRO_H1B', 'Scanned Identification Required');
	define('_CONTENT_HELP_ENTITY_INTRO_H1C', 'Time this signature is active for');
	define('_CONTENT_HELP_ENTITY_INTRO_H1D', 'Select your signature class');
	define('_CONTENT_HELP_ENTITY_INTRO_H1E', 'Entity Information Required');
	define('_CONTENT_HELP_ENTITY_INTRO_H1F', 'Time this signature is active for');
	define('_CONTENT_HELP_ENTITY_INTRO_PT', 'Introduction');

	define('_CONTENT_HELP_ENTITY_FINISH_PT', 'Finished');
	define('_CONTENT_HELP_ENTITY_FINISH_P1', 'You have <em>finished making your Digital Signature</em>, Congradulations! Below is a list of the resources that will have to be verified, these are typically email addresses and when they are you will be emailed your Digital Signature.');
	define('_CONTENT_HELP_ENTITY_FINISH_H1A', 'Emails to be verified');
	define('_CONTENT_HELP_ENTITY_FINISH_H1B', 'Mobile Phones to be verified');
	define('_CONTENT_HELP_ENTITY_FINISH_LIA', '%s <strong>%s</strong>');
	define('_CONTENT_HELP_ENTITY_FINISH_LIB', '+%s <strong>Verification SMS Sent</strong>');
	define('_CONTENT_HELP_ENTITY_STATE_1A', 'Emails to be verified');
	define('_CONTENT_HELP_ENTITY_STATE_1B', "Not Done");	

	define('_CONTENT_HELP_IDENTIFICATION_NEEDED_P1', 'Here you will need to specify the Personal Identification you are going to encode into the Digital Signature!');
	define('_CONTENT_HELP_IDENTIFICATION_NEEDED_P2', 'You will have to have scanned images which match one of the following dimension or larger, the larger the better so we can resize them for you. The dimensions must be at least the following in size in pixels <em>(measurements in <strong>Width</strong>x<strong>Height</strong>):~ <br/><br/><strong>');
	define('_CONTENT_HELP_IDENTIFICATION_NEEDED_DIV1', '~ %s - <em>Points: <strong>%s</strong></em>');
	define('_CONTENT_HELP_IDENTIFICATION_NEEDED_DIV2', 'Total points selected: <span id="total-points">0</span>');
	define('_CONTENT_HELP_IDENTIFICATION_NEEDED_H1A', 'Select the Identification you have scanned and have ready to proceed!');
	define('_CONTENT_HELP_IDENTIFICATION_NEEDED_PT', 'Required Identification(s)');
	
	define('_CONTENT_HELP_IDENTIFICATION_FINISHED_P1', 'You have <em>finished making your update to your identification on you Digital Signature</em>, Congradulations! Soon will notify other websites of your update if they have subscribed to your signature and pass the new information on.');
	define('_CONTENT_HELP_IDENTIFICATION_FINISHED_PT', 'Finished');
	
	define('_CONTENT_FIELDS_PERSONAL_FORM_P1', 'Fill out this form for your personal &amp; individual information, only!');
	define('_CONTENT_FIELDS_PERSONAL_FORM_H1A', 'Personal Information Required');
	define('_CONTENT_FIELDS_PERSONAL_FORM_PT', 'Personal Details');

	define('_CONTENT_FIELDS_ENTITY_FORM_P1', 'Fill out this form for your business or government entity, only ~ the details are only for your entity, your personal information will be asked for next!');
	define('_CONTENT_FIELDS_ENTITY_FORM_H1A', 'Entity Information Required');
	define('_CONTENT_FIELDS_ENTITY_FORM_PT', 'Business/Government Entity Details');
	
	define('_CONTENT_FIELDS_IDENTIFICATION_FORM_P1', 'Fill out this form for identification type:~ <strong>%s</strong>, only!');
	define('_CONTENT_FIELDS_IDENTIFICATION_FORM_H1A', '%s Personal Identification Required');
	define('_CONTENT_FIELDS_IDENTIFICATION_FORM_PT', '%s Identification');
	
	define('_CONTENT_DEPLOYED_PERSONAL_EMAIL_P1', 'Sending Verification Correspondence');
	define('_CONTENT_DEPLOYED_PERSONAL_EMAIL_P2', 'You will be redirected to the finish screen in a seconds!<br/><br/><img src="%s/loading.gif"/><br/><br/>If you are not redirected click <a href="%s">here!');

	define('_CONTENT_DEPLOYED_ENTITY_EMAIL_P1', 'Sending Verification Correspondence');
	define('_CONTENT_DEPLOYED_ENTITY_EMAIL_P2', 'You will be redirected to the finish screen in a seconds!<br/><br/><img src="%s/loading.gif"/><br/><br/>If you are not redirected click <a href="%s">here!');
	
	define('_CONTENT_COMMON_NOURL_P1', 'No Corresponding URL Data!');
	define('_CONTENT_COMMON_NOURL_P2', 'You will be redirected to the finish screen in a seconds!<br/><br/><img src="%s/loading.gif"/><br/><br/>If you are not redirected click <a href="%s">here!');
	
	define('_CONTENT_COMMON_START_P1', 'From here you can select the type of Digital Signature you would like to create, it outlines the basis of the signature, make sure you choose carefully by clicking on the button for the type you want to create!<br/><br/>You will be then be given some instructions then prompted for all the data you will require to generate the signature!');
	define('_CONTENT_COMMON_START_P2', 'Select a Language: ');
	define('_CONTENT_COMMON_START_IP1', 'Generate a %s Signature');
	define('_CONTENT_COMMON_START_DIV1', 'System Version:&nbsp;<strong>%s</strong>');
	define('_CONTENT_COMMON_START_DIV2', '<em>%s</em> ~ Host Code:&nbsp;<strong>%s</strong>');

	define('_CONTENT_COMMON_UPDATE_P1', 'Redirecting you!');
	define('_CONTENT_COMMON_UPDATE_P2', 'You will be redirected to the finish screen in a seconds!<br/><br/><img src="%s/loading.gif"/><br/><br/>If you are not redirected click <a href="%s">here!');
	
	?>
