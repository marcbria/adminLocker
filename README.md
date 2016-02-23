adminLocker
===========

PKP-OJS plugin to lock the specified pages/forms for every user except the pivileged ones. 


Configuration
=============

The pages that need to be locked and the users the privileged users are defined
in the plugin's config file (/plugins/generic/adminlocker/config.inc.php).

You need to modifiy this file to fit your needs.

The configuration file includes two main sections: "allowedUsers" and "disabledPages"

Add your privileged usernames to the "allowedUsers" array as follows:

    user[]='admin'
    user[]='root'

To lock pages/forms you need it's "pageTitle". 
Tip: Set the variable "pageTitle" to TRUE to show the "pageTitle" of each page.

Add your locked pages to "disabedPages" as follows:

    manager.setup.gettingDownTheDetails = "forms"       ; /manager/setup/1
    manager.setup.journalPolicies = "forms"             ; /manager/setup/2
    manager.setup.guidingSubmissions = "all"            ; /manager/setup/3
    manager.setup.managingTheJournal = "forms"          ; /manager/setup/4
    manager.setup.customizingTheLook = "all"            ; /manager/setup/5
    common.languages = "all"                            ; /manager/languages  
    manager.plugins.pluginManagement = "info"           ; /manager/plugins
    manager.plugins.install = "info"
    manager.plugins.upgrade = "info"
    manager.plugins.delete = "info"

The module implements 4 different types of locks:

- links: Make links of the content area useless.
- forms: Disable input, select, button and textarea.
- info: Replace page with a lock info page.
- all: Locks the form at "links" and "forms" level.


Advice
======

This module is designed to avoid unexpert users reach harmful areas.
This is not a security module so it DO NOT claim to be secure. 

In this sense, you need to take in consideration that the module won't 
be able to lock:

- If the page lacks of $pageTitle.
- If the action is against an URL (no page is generated).
- "links" and "forms" locking won't work with pages created in the client side (pe: JS, AJAX).


Improvements/ideas/todos
========================

- Allow to config from a webUI?
- Offer diferent config files for each journal? Move config.inc.php to webdata?
- Use OJS templates?
- Use OJS notification system?
- Use an HTML parser as DOMDocument or simpleXML?
- Redesign it all? Use FBV framework instead of filtering generated code?
- Instead of "pageTitle" improve the locking identification based on... what? urls?

ToDo
====

- ...
