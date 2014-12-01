; <?php exit(); DO NOT DELETE ?>                                                                                                                          
; DO NOT DELETE THE ABOVE LINE!!!
; Doing so will expose this configuration file through your web site!
;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;

;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;
;
; config.inc.php
;
; Configuration file for module "adminlock".
;
; Copyright (c) 2014 Marc Bria (Universitat Autònoma de Barcelona).
; Distributed under the GNU GPL v3. 
;
;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;

;;;;;;;;;;;;;;;;;;;;
; Debug            ;
;;;;;;;;;;;;;;;;;;;;

[debug]

; To lock pages you need it's "pageTitle": Set this variable to TRUE 
; to show the "pageTitle" in the content area of each page.
; If you prefer, you can also enable smarty {debug} in the OJS templates
; and check the variable $pageTitle of the page/form you want to lock.

; pageTitle = TRUE
pageTitle = FALSE
showLocked = TRUE

;;;;;;;;;;;;;;;;;;;;
; Allowed Users    ;
;;;;;;;;;;;;;;;;;;;;

[allowedUsers]

; List of usernames that WILL NOT be locked 
; and will be able to reach the forms normally.
user[] = 'admin'
user[] = 'root'



;;;;;;;;;;;;;;;;;;;;
; Disabled Pages   ;
;;;;;;;;;;;;;;;;;;;;

; This section include the list of form titles that need to be locked.
;
; There are 4 different types of locks:
; * links: Make links of the content area useless.
; * forms: Disable input, select, button and textarea.
; * info: Replace page with a lock info page.
; * all: Locks the form at "links" and "forms" level.
;
; Uncomment or modify to fit your needs:

[disabledPages]


;; Journal Manager:
;; No restrictions applied
; manager.journalManagement = "info"                ; /manager

;; Journal Manager: Setup
;; Configured to see but don't touch.

; manager.setup.journalSetup = 'links'              ; /manager/setup
    manager.setup.gettingDownTheDetails = "forms"       ; /manager/setup/1
    manager.setup.journalPolicies = "forms"             ; /manager/setup/2
    manager.setup.guidingSubmissions = "all"            ; /manager/setup/3
    manager.setup.managingTheJournal = "forms"          ; /manager/setup/4
    manager.setup.customizingTheLook = "forms"          ; /manager/setup/5


;; Journal Manager: Languages
;; Configured to see but don't touch.
common.languages = "all"                            ; /manager/languages  

;; Journal Manager: Files Browser
;; No resctrictions applied.
; manager.filesBrowser = "all"                      ; /manager/files

;; Journal Manager: Announcementsreport
;; No resctrictions applied.
; manager.announcements = "all"                     ; /manager/announcements
    ; manager.announcementTypes = "all"  

;; Journal Manager: Review Forms
;; No restrictions applied.
; manager.reviewForms = "all"                       ; /manager/reviewForms
    ; manager.reviewForms.create = "all"

;; Journal Manager: MasterHead
;; No restrictions applied.
; manager.groups = "all"                            ; /manager/groups
    ; manager.groups.membership = "all"
    ; manager.groups.editTitle = "all"
    ; manager.groups.createTitle = "all"

;; Journal Manager: Prepared emails
;; No restrictions applied.
; manager.emails = "info"                           ; /manager/emails
    ; manager.emails.editEmail = "all"

;; Journal Manager: Reading tools
;; No restrictions applied.
; rt.readingTools = "info"                          ; /manager/rt
    ; rt.admin = "all"
    ; rt.admin.settings = "all"
    ; rt.versions = "all"
    ; rt.searches = "all"
    ; rt.readingTools = "all"
    ; rt.admin.sharing = "all"

;; Journal Manager: Stats and reports
;; No restrictions applied.
; manager.statistics = "all"                        ; /manager/statistics
    ; plugins.reports.counter = "all"
    ; plugins.reports.timedView.displayName = "all"

; This is loaded via AJAX so it can't be locked right now:
; manager.statistics.reports = "all"

;; Journal Manager: Payments
;; No restrictions applied.
; manager.payment.feePaymentOptions = "all"
    ; manager.payment.paymentMethods = "all"
    ; common.payments = "all"

;; Journal Manager: Payments
;; No restrictions applied.
; plugins.categories.pubIds = "info"
    ; plugins.pubIds.urn.manager.settings.urnSettings = "info"
    ; plugins.pubIds.doi.manager.settings.doiSettings = "info"

;; Journal Manager: Plugins
;; Locked and hidden.
; manager.plugins.pluginManagement = "info"                     ; /manager/plugins
    manager.plugins.install = "info"
    manager.plugins.upgrade = "info"
    manager.plugins.delete = "info"
    plugins.categories.metadata = "info"
    plugins.categories.auth = "info"
    plugins.categories.blocks = "info"
    plugins.categories.citationFormats = "info"
    plugins.categories.citationLookup = "info"
    plugins.categories.citationOutput = "info"
    plugins.categories.citationParser = "info"
    plugins.categories.gateways = "info"
    plugins.categories.implicitAuth = "info"
    plugins.categories.importexport = "info"
    plugins.gateways.metsGateway.displayName = "info"
        plugins.citationFormats.abnt.manager.AbntCitationSettings = "info"
        plugins.generic.customBlock.editContent = "info"
    plugins.generic.staticPages.displayName = "info"
        plugins.generic.staticPages.editStaticPage = "info"
        plugins.generic.staticPages.addStaticPage = "info"
    plugins.generic.googleAnalytics.manager.googleAnalyticsSettings = "info"
    plugins.generic.webfeed.displayName = "info"
    plugins.generic.customLocale.name = "info"
    plugins.generic.referral.settings = "info"
    plugins.generic.customBlockManager.displayName = "info"
    plugins.generic.usageStats.displayName = "info"
    plugins.generic.piwik.manager.piwikSettings = "info"
    plugins.generic.xmlGalley.displayName = "info"
    plugins.generic.stopForumSpam.manager.stopForumSpamSettings = "info"
    plugins.generic.lucene.settings.luceneSettings = "info"
    plugins.generic.googleAnalytics.manager.googleAnalyticsSettings = "info"
    plugins.generic.alm.displayName = "info"
    plugins.generic.sword.displayName = "info"
    plugins.generic.sword.depositPoints.edit = "info"
    plugins.generic.thesisfeed.displayName = "info"
    plugins.generic.phpmv.manager.phpmvSettings = "info"
    plugins.generic.browse.manager.settings.browseSettings = "info"
    plugins.generic.translator.name = "info"

;; Journal Manager: External Feeds
;; No restrictions applied.
; plugins.generic.externalFeed.manager.settings = "all"
    ; plugins.generic.externalFeed.manager.feeds = "all"
    ; plugins.generic.externalFeed.manager.create = "all"

;; Journal Manager: Import & Export
;; No restrictions applied.
; manager.importExport = "all"
    ; plugins.importexport.native.displayName = "all"
    ; plugins.importexport.native.selectArticle = "all"
    ; plugins.importexport.native.selectIssue = "all"
    ; plugins.importexport.pubIds.displayName = "all"
    ; plugins.importexport.duracloud.displayName = "all"
    ; plugins.importexport.users.displayName = "all"
    ; plugins.importexport.METSExport.displayName = "all"
    ; plugins.importexport.METSExport.export.selectIssue = "all"
    ; plugins.importexport.doaj.displayName = "all"
    ; plugins.importexport.datacite.displayName = "all"
    ; plugins.importexport.common.settings = "all"
    ; plugins.importexport.common.export.select = "all"
    ; plugins.importexport.common.export.selectIssue = "all"
    ; plugins.importexport.common.export.selectArticle = "all"
    ; plugins.importexport.common.export.selectGalley = "all"
    ; plugins.importexport.datacite.export.selectSuppFile = "all"
    ; plugins.importexport.pubmed.displayName = "all"
    ; plugins.importexport.pubmed.export.selectIssue = "all"
    ; plugins.importexport.pubmed.export.selectArticle = "all"
    ; plugins.importexport.quickSubmit.displayName = "all"
    ; plugins.importexport.erudit.selectArticle = "all"
    ; plugins.importexport.medra.displayName = "all"
    ; plugins.importexport.crossref.displayName = "all"
    ; plugins.importexport.crossref.export.selectIssue = "all"
    ; plugins.importexport.crossref.export.selectArticle = "all"

;; Journal Manager: Users
;; No restrictions applied.
; manager.people = "all"                            ; /manager/people
    ; manager.people.enrollment = "all"                 ; /manager/people/all
    ; manager.people.mergeUsers = "all"                 ; /manager/mergeUsers


; Here you have a non exhaustive list of pages that misses a unique $pageTitle:
;
; Custom Locale module:
; List: /manager/plugin/generic/customlocaleplugin/edit/en_US
; Edit: /plugin/generic/customlocaleplugin/editLocaleFile/en_US/lib%25252Fpkp%25252Flocale%25252Fen_US%25252Fcommon.xml
; User admin:
; Enrolment: /manager/enrollSearch
