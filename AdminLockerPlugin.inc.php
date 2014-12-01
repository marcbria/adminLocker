<?php

/**
 * @file plugins/generic/adminLocker/AdminLockerPlugin.inc.php
 *
 * Copyright (c) 2014 Marc Bria Ramírez, Universitat Autònoma de Barcelona
 * Distributed under the GNU GPL v3.
 *
 * @class AdminLockerPlugin
 * @ingroup plugins_generic_adminLocker
 *
 * @author Marc Bria
 * @brief Admin Locker plugin class
 *
 */

import('lib.pkp.classes.plugins.GenericPlugin');

class AdminLockerPlugin extends GenericPlugin {
    function getDisplayName() {
        return __('plugins.generic.adminlocker.displayName');
    }

    function getDescription() {
        return __('plugins.generic.adminlocker.description');
    }

    function register($category, $path) {
        if (parent::register($category, $path)) {
            if (!Config::getVar('general', 'installed') || defined('RUNNING_UPGRADE')) return true;
            if ( $this->getEnabled() ) {
                HookRegistry::register('TemplateManager::display', array(&$this, 'templateManagerCallback'));
            }
            return true;
        }
        return false;
    }

    function templateManagerCallback($hookName, $args) {
        $templateMgr =& $args[0]; //TemplateManager::getManager();
        $baseUrl = $templateMgr->get_template_vars('baseUrl');
        $adminLockerCssUrl = $baseUrl . '/plugins/generic/adminLocker/adminlocker.css';
        $templateMgr->addStyleSheet($adminLockerCssUrl);

        $templateMgr->register_outputfilter(array('AdminLockerPlugin', 'lockerOutputFilter'));
    }

    /**
     * Disable html elements in content area using "PHP Simple HMTL DOM Parser"
     * http://simplehtmldom.sourceforge.net/manual.htm
     */
    function lockerOutputFilter($output, &$smarty) {

        // WARNING: Reading symlinks instead of realpath/pathinfo to make it mOJO compliant.
        $pluginLinkedPath=dirname($_SERVER["SCRIPT_FILENAME"]).'/plugins/generic/adminLocker';

        // Reading config file:
        $lockConfig = parse_ini_file($pluginLinkedPath. '/config.inc.php', true);

        $allowedUsers = $lockConfig['allowedUsers']['user'];
        $loggedInuser = $smarty->get_template_vars('loggedInUsername');
        $showPageTitle = $lockConfig['debug']['pageTitle'];
        $showLocked = $lockConfig['debug']['showLocked'];
        $whereAmI = $smarty->get_template_vars('pageTitle');
        $disabledPages = $lockConfig['disabledPages'];
        $disabledPage = FALSE;

        if ( array_key_exists($whereAmI, $disabledPages) ) {
            $disabledPage = TRUE;
        }

        if ( ! in_array($loggedInuser, $allowedUsers)) {

            if ( $disabledPage ) {

                if (strpos ($output, '<div id="content">')) {

                    $notificationTitle=__('plugins.generic.adminlocker.notification.title');
                    $notificationDesc =__('plugins.generic.adminlocker.notification.description');

                    $notification="\t\t<h3>$notificationTitle</h3>";
                    $notification.="\t\t<p>$notificationDesc</p>";


                    if ($disabledPages[$whereAmI] == 'info') {

                        // Improvement: Replace it all with an OJS template?

                        $pattern = '/<body.*<\/body>/s';

                        $notification.="\t\t<form><input type=\"button\" value=\"".__('plugins.generic.adminlocker.notification.goBack');
                        $notification.="\" onClick=\"history.go(-1);return true;\" /></form>";

                        $notificationHTML="<body id=\"$whereAmI\">\n".
                                            "\t<div class=\"adminlock message fixed\">".
                                            $notification.
                                            "\t</div>\n".
                                            "</body>";

                        $newOutput = preg_replace($pattern, $notificationHTML, $output);

                        $output = $newOutput;

                    }
                    else {

                        // We only want to modify the "content" area, so...

                        // Divide html content in two slices:
                        $outputSplit=explode('id="content"',$output);


                        if (($disabledPages[$whereAmI] == 'forms') || ($disabledPages[$whereAmI] == 'all')) {

                            //Inputs:
                            $newOutput = str_replace('<input ','<input disabled ', $outputSplit[1]);
                            $outputSplit[1]=$newOutput;

                            //Selects:
                            $newOutput = str_replace('<select ','<select disabled ', $outputSplit[1]);
                            $outputSplit[1]=$newOutput;

                            //Textareas:
                            $newOutput = str_replace('<textarea ','<textarea disabled ', $outputSplit[1]);
                            $outputSplit[1]=$newOutput;

                            //Disable tinyMCE: This is done at "header" slice.
                            $newOutput = str_replace('themes : "advanced",' , "themes : \"advanced\",\n\t\t\t\t\treadonly : 1,", $outputSplit[0]);
                            $outputSplit[0]=$newOutput;
                            $newOutput = str_replace('theme : "advanced",' , "theme : \"advanced\",\n\t\t\t\t\treadonly : 1,", $outputSplit[0]);
                            $outputSplit[0]=$newOutput;

                        }

                        if (($disabledPages[$whereAmI] == 'links') || ($disabledPages[$whereAmI] == 'all')) {

                            $pattern = '/a href="([^"]*)"/';
                            $replace = 'a href="javascript:void(0)"';

                            $newOutput = preg_replace($pattern, $replace, $outputSplit[1]);
                            $outputSplit[1]=$newOutput;
                        }

                        // Joining the parts:
                        $output=implode('id="content"', $outputSplit);

                        // Report about the changes:
                        $notificationHTML="\t<div class=\"adminlock message relative\">".
                                            $notification.
                                            "\t</div>\n";

                        // Improvements: Notify using OJS notification system??
                        $newOutput = str_replace('<div id="content">','<div id="content"><div class="adminlock message relative">'.$notification."</div>", $output);
                        $output=$newOutput;

                    } // if $disabledPages
                } 
            }
        }

        // Helper: Show pageTitle smarty variable if config.inc.php requests for it.
        if ($showPageTitle) {
            $notification =  "<div id=\"content\">\n<div class=\"adminlock message relative\">\n";
            $notification .= __('plugins.generic.adminlocker.debug.info') . ": <br />\n";
            $notification .= $whereAmI . " = \"info\"</div>\n";
            $output = str_replace('<div id="content">',$notification, $output);
        }

        // Page in the lock-list and corner alert is enabled ("showlocked").
        if ( $showLocked && $disabledPage) {
            $corner = "<div id=\"content\">\n<div id=\"showLocked\" class=\"adminlock\"></div>\n";
            $output = str_replace('<div id="content">', $corner, $output);
        }

        return $output;
    }
}
?>