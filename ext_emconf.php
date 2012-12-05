<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "seminars".
 *
 * Auto generated 05-12-2012 11:05
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Seminar Manager',
	'description' => 'This extension allows you to create and manage a list of seminars, workshops, lectures, theater performances and other events, allowing front-end users to sign up. FE users also can create and edit events.',
	'category' => 'plugin',
	'shy' => 0,
	'dependencies' => 'cms,css_styled_content,oelib,ameos_formidable,static_info_tables,static_info_tables_taxes',
	'conflicts' => 'dbal,sourceopt',
	'priority' => '',
	'loadOrder' => '',
	'module' => 'BackEnd,BackEndExtJs',
	'state' => 'beta',
	'internal' => 0,
	'uploadfolder' => 1,
	'createDirs' => '',
	'modify_tables' => 'be_groups,fe_groups,fe_users',
	'clearCacheOnLoad' => 1,
	'lockType' => '',
	'author' => 'Oliver Klee',
	'author_email' => 'typo3-coding@oliverklee.de',
	'author_company' => 'oliverklee.de',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'version' => '0.9.74',
	'_md5_values_when_last_written' => 'a:308:{s:13:"changelog.txt";s:4:"df5f";s:20:"class.ext_update.php";s:4:"06a1";s:33:"class.tx_seminars_configcheck.php";s:4:"6df0";s:34:"class.tx_seminars_configgetter.php";s:4:"c053";s:37:"class.tx_seminars_EmailSalutation.php";s:4:"bcb2";s:31:"class.tx_seminars_flexForms.php";s:4:"2e12";s:34:"class.tx_seminars_registration.php";s:4:"54ed";s:41:"class.tx_seminars_registrationmanager.php";s:4:"cb22";s:29:"class.tx_seminars_seminar.php";s:4:"bc4d";s:29:"class.tx_seminars_speaker.php";s:4:"8f7e";s:29:"class.tx_seminars_tcemain.php";s:4:"642d";s:30:"class.tx_seminars_timeslot.php";s:4:"107c";s:30:"class.tx_seminars_timespan.php";s:4:"262b";s:16:"ext_autoload.php";s:4:"f991";s:21:"ext_conf_template.txt";s:4:"a043";s:12:"ext_icon.gif";s:4:"35fc";s:17:"ext_localconf.php";s:4:"2fc4";s:14:"ext_tables.php";s:4:"79f2";s:14:"ext_tables.sql";s:4:"b5cd";s:13:"locallang.xml";s:4:"0f11";s:16:"locallang_db.xml";s:4:"671f";s:8:"todo.txt";s:4:"9f3f";s:36:"tx_seminars_modifiedSystemTables.php";s:4:"84d9";s:33:"BackEnd/AbstractEventMailForm.php";s:4:"3f4c";s:24:"BackEnd/AbstractList.php";s:4:"acb9";s:19:"BackEnd/BackEnd.css";s:4:"b59c";s:31:"BackEnd/CancelEventMailForm.php";s:4:"e594";s:16:"BackEnd/conf.php";s:4:"7ce7";s:32:"BackEnd/ConfirmEventMailForm.php";s:4:"d088";s:15:"BackEnd/CSV.php";s:4:"9b76";s:22:"BackEnd/EventsList.php";s:4:"f18c";s:32:"BackEnd/GeneralEventMailForm.php";s:4:"118d";s:17:"BackEnd/index.php";s:4:"b259";s:21:"BackEnd/locallang.xml";s:4:"298f";s:25:"BackEnd/locallang_mod.xml";s:4:"0cdd";s:18:"BackEnd/Module.php";s:4:"7a50";s:22:"BackEnd/moduleicon.gif";s:4:"032e";s:26:"BackEnd/OrganizersList.php";s:4:"f179";s:29:"BackEnd/RegistrationsList.php";s:4:"757c";s:24:"BackEnd/SpeakersList.php";s:4:"eda0";s:27:"BackEndExtJs/ClearCache.php";s:4:"6194";s:21:"BackEndExtJs/conf.php";s:4:"9c7f";s:22:"BackEndExtJs/index.php";s:4:"67fe";s:23:"BackEndExtJs/Module.php";s:4:"d7dc";s:34:"BackEndExtJs/Ajax/AbstractList.php";s:4:"a6b2";s:32:"BackEndExtJs/Ajax/Dispatcher.php";s:4:"89e6";s:32:"BackEndExtJs/Ajax/EventsList.php";s:4:"db83";s:36:"BackEndExtJs/Ajax/OrganizersList.php";s:4:"145e";s:39:"BackEndExtJs/Ajax/RegistrationsList.php";s:4:"26de";s:34:"BackEndExtJs/Ajax/SpeakersList.php";s:4:"c13c";s:35:"BackEndExtJs/Ajax/StateProvider.php";s:4:"5cef";s:16:"Bag/Abstract.php";s:4:"1e2d";s:16:"Bag/Category.php";s:4:"0d39";s:13:"Bag/Event.php";s:4:"e39a";s:17:"Bag/Organizer.php";s:4:"0903";s:20:"Bag/Registration.php";s:4:"0851";s:15:"Bag/Speaker.php";s:4:"817d";s:16:"Bag/TimeSlot.php";s:4:"6103";s:23:"BagBuilder/Abstract.php";s:4:"7b76";s:23:"BagBuilder/Category.php";s:4:"88c8";s:20:"BagBuilder/Event.php";s:4:"de4a";s:24:"BagBuilder/Organizer.php";s:4:"9120";s:27:"BagBuilder/Registration.php";s:4:"8e70";s:22:"BagBuilder/Speaker.php";s:4:"c487";s:41:"Configuration/FlexForms/flexforms_pi1.xml";s:4:"9b64";s:25:"Configuration/TCA/tca.php";s:4:"0da2";s:38:"Configuration/TypoScript/constants.txt";s:4:"1559";s:34:"Configuration/TypoScript/setup.txt";s:4:"fb4f";s:25:"FrontEnd/AbstractView.php";s:4:"a062";s:25:"FrontEnd/CategoryList.php";s:4:"80b0";s:22:"FrontEnd/Countdown.php";s:4:"ab6e";s:30:"FrontEnd/DefaultController.php";s:4:"5670";s:19:"FrontEnd/Editor.php";s:4:"063d";s:24:"FrontEnd/EventEditor.php";s:4:"5591";s:26:"FrontEnd/EventHeadline.php";s:4:"006c";s:25:"FrontEnd/PublishEvent.php";s:4:"1ccd";s:29:"FrontEnd/RegistrationForm.php";s:4:"59fd";s:30:"FrontEnd/RegistrationsList.php";s:4:"a93b";s:29:"FrontEnd/RequirementsList.php";s:4:"d69a";s:27:"FrontEnd/SelectorWidget.php";s:4:"3ed7";s:23:"FrontEnd/WizardIcon.php";s:4:"e971";s:20:"Interface/Titled.php";s:4:"f8dd";s:32:"Interface/Hook/BackEndModule.php";s:4:"88d4";s:32:"Interface/Hook/EventListView.php";s:4:"19f7";s:34:"Interface/Hook/EventSingleView.php";s:4:"1954";s:22:"Mapper/BackEndUser.php";s:4:"d3f7";s:27:"Mapper/BackEndUserGroup.php";s:4:"4930";s:19:"Mapper/Category.php";s:4:"8cab";s:19:"Mapper/Checkbox.php";s:4:"d982";s:16:"Mapper/Event.php";s:4:"0d8c";s:20:"Mapper/EventType.php";s:4:"d33f";s:15:"Mapper/Food.php";s:4:"7f80";s:23:"Mapper/FrontEndUser.php";s:4:"d3ea";s:28:"Mapper/FrontEndUserGroup.php";s:4:"cff8";s:18:"Mapper/Lodging.php";s:4:"6528";s:20:"Mapper/Organizer.php";s:4:"8316";s:24:"Mapper/PaymentMethod.php";s:4:"d60c";s:16:"Mapper/Place.php";s:4:"f36a";s:23:"Mapper/Registration.php";s:4:"24b6";s:16:"Mapper/Skill.php";s:4:"f2b2";s:18:"Mapper/Speaker.php";s:4:"8912";s:22:"Mapper/TargetGroup.php";s:4:"2626";s:19:"Mapper/TimeSlot.php";s:4:"2c38";s:26:"Model/AbstractTimeSpan.php";s:4:"19bd";s:21:"Model/BackEndUser.php";s:4:"2b3b";s:26:"Model/BackEndUserGroup.php";s:4:"4c48";s:18:"Model/Category.php";s:4:"a3ef";s:18:"Model/Checkbox.php";s:4:"fb7f";s:15:"Model/Event.php";s:4:"bfd2";s:19:"Model/EventType.php";s:4:"ffc3";s:14:"Model/Food.php";s:4:"9bcb";s:22:"Model/FrontEndUser.php";s:4:"fa99";s:27:"Model/FrontEndUserGroup.php";s:4:"8f37";s:17:"Model/Lodging.php";s:4:"946d";s:19:"Model/Organizer.php";s:4:"67d5";s:23:"Model/PaymentMethod.php";s:4:"2fec";s:15:"Model/Place.php";s:4:"2f82";s:22:"Model/Registration.php";s:4:"c835";s:15:"Model/Skill.php";s:4:"258c";s:17:"Model/Speaker.php";s:4:"5b77";s:21:"Model/TargetGroup.php";s:4:"bf7f";s:18:"Model/TimeSlot.php";s:4:"e401";s:21:"OldModel/Abstract.php";s:4:"3a8e";s:21:"OldModel/Category.php";s:4:"856d";s:22:"OldModel/Organizer.php";s:4:"18d1";s:38:"Resources/Private/CSS/thankYouMail.css";s:4:"4e2b";s:40:"Resources/Private/Language/locallang.xml";s:4:"909d";s:54:"Resources/Private/Language/locallang_csh_fe_groups.xml";s:4:"2c9e";s:53:"Resources/Private/Language/locallang_csh_seminars.xml";s:4:"f521";s:49:"Resources/Private/Language/FrontEnd/locallang.xml";s:4:"a931";s:51:"Resources/Private/Templates/BackEnd/EventsList.html";s:4:"41ea";s:55:"Resources/Private/Templates/BackEnd/OrganizersList.html";s:4:"abb9";s:58:"Resources/Private/Templates/BackEnd/RegistrationsList.html";s:4:"c80e";s:53:"Resources/Private/Templates/BackEnd/SpeakersList.html";s:4:"cf8a";s:53:"Resources/Private/Templates/FrontEnd/EventEditor.html";s:4:"4498";s:50:"Resources/Private/Templates/FrontEnd/FrontEnd.html";s:4:"41c5";s:60:"Resources/Private/Templates/FrontEnd/RegistrationEditor.html";s:4:"2a53";s:44:"Resources/Private/Templates/Mail/e-mail.html";s:4:"619c";s:38:"Resources/Public/CSS/BackEnd/Print.css";s:4:"d41d";s:45:"Resources/Public/CSS/BackEndExtJs/BackEnd.css";s:4:"e32a";s:43:"Resources/Public/CSS/BackEndExtJs/Print.css";s:4:"d41d";s:42:"Resources/Public/CSS/FrontEnd/FrontEnd.css";s:4:"bf1f";s:35:"Resources/Public/Icons/Canceled.png";s:4:"4161";s:35:"Resources/Public/Icons/Category.gif";s:4:"c95b";s:35:"Resources/Public/Icons/Checkbox.gif";s:4:"f1f0";s:36:"Resources/Public/Icons/Confirmed.png";s:4:"77af";s:40:"Resources/Public/Icons/ContentWizard.gif";s:4:"5e60";s:40:"Resources/Public/Icons/EventComplete.gif";s:4:"d4db";s:43:"Resources/Public/Icons/EventComplete__h.gif";s:4:"ccf3";s:43:"Resources/Public/Icons/EventComplete__t.gif";s:4:"a5cc";s:36:"Resources/Public/Icons/EventDate.gif";s:4:"7853";s:39:"Resources/Public/Icons/EventDate__h.gif";s:4:"fd86";s:39:"Resources/Public/Icons/EventDate__t.gif";s:4:"acc7";s:37:"Resources/Public/Icons/EventTopic.gif";s:4:"e4b1";s:40:"Resources/Public/Icons/EventTopic__h.gif";s:4:"4689";s:40:"Resources/Public/Icons/EventTopic__t.gif";s:4:"e220";s:36:"Resources/Public/Icons/EventType.gif";s:4:"61a5";s:31:"Resources/Public/Icons/Food.gif";s:4:"1024";s:34:"Resources/Public/Icons/Lodging.gif";s:4:"5fdf";s:36:"Resources/Public/Icons/Organizer.gif";s:4:"1e7e";s:40:"Resources/Public/Icons/PaymentMethod.gif";s:4:"44bd";s:32:"Resources/Public/Icons/Place.gif";s:4:"2694";s:32:"Resources/Public/Icons/Price.gif";s:4:"61a5";s:32:"Resources/Public/Icons/Print.png";s:4:"2424";s:39:"Resources/Public/Icons/Registration.gif";s:4:"d892";s:42:"Resources/Public/Icons/Registration__h.gif";s:4:"5571";s:32:"Resources/Public/Icons/Skill.gif";s:4:"30a2";s:34:"Resources/Public/Icons/Speaker.gif";s:4:"ddc1";s:38:"Resources/Public/Icons/TargetGroup.gif";s:4:"b5a7";s:31:"Resources/Public/Icons/Test.gif";s:4:"bd58";s:35:"Resources/Public/Icons/TimeSlot.gif";s:4:"bb73";s:51:"Resources/Public/JavaScript/BackEndExtJs/BackEnd.js";s:4:"f100";s:48:"Resources/Public/JavaScript/FrontEnd/FrontEnd.js";s:4:"2ebd";s:33:"Service/SingleViewLinkBuilder.php";s:4:"5d0b";s:35:"ViewHelper/CommaSeparatedTitles.php";s:4:"07bd";s:24:"ViewHelper/Countdown.php";s:4:"8ebb";s:24:"ViewHelper/DateRange.php";s:4:"68cd";s:24:"ViewHelper/TimeRange.php";s:4:"8711";s:42:"cli/class.tx_seminars_cli_MailNotifier.php";s:4:"f8c7";s:23:"cli/tx_seminars_cli.php";s:4:"51a0";s:20:"doc/dutch-manual.pdf";s:4:"beed";s:21:"doc/german-manual.sxw";s:4:"b63f";s:14:"doc/manual.sxw";s:4:"eb8f";s:29:"pi2/class.tx_seminars_pi2.php";s:4:"52dc";s:17:"pi2/locallang.xml";s:4:"ef40";s:25:"tests/ConfigCheckTest.php";s:4:"501f";s:43:"tests/BackEnd/AbstractEventMailFormTest.php";s:4:"1203";s:41:"tests/BackEnd/CancelEventMailFormTest.php";s:4:"fa72";s:42:"tests/BackEnd/ConfirmEventMailFormTest.php";s:4:"4312";s:32:"tests/BackEnd/EventsListTest.php";s:4:"d862";s:31:"tests/BackEnd/FlexFormsTest.php";s:4:"41f2";s:42:"tests/BackEnd/GeneralEventMailFormTest.php";s:4:"8de1";s:28:"tests/BackEnd/ModuleTest.php";s:4:"08e2";s:36:"tests/BackEnd/OrganizersListTest.php";s:4:"87fc";s:39:"tests/BackEnd/RegistrationsListTest.php";s:4:"2142";s:34:"tests/BackEnd/SpeakersListTest.php";s:4:"021f";s:33:"tests/BackEndExtJs/ModuleTest.php";s:4:"d22a";s:44:"tests/BackEndExtJs/Ajax/AbstractListTest.php";s:4:"0f2c";s:42:"tests/BackEndExtJs/Ajax/DispatcherTest.php";s:4:"a5d2";s:42:"tests/BackEndExtJs/Ajax/EventsListTest.php";s:4:"e169";s:46:"tests/BackEndExtJs/Ajax/OrganizersListTest.php";s:4:"4508";s:49:"tests/BackEndExtJs/Ajax/RegistrationsListTest.php";s:4:"6dec";s:44:"tests/BackEndExtJs/Ajax/SpeakersListTest.php";s:4:"7d48";s:45:"tests/BackEndExtJs/Ajax/StateProviderTest.php";s:4:"a39b";s:26:"tests/Bag/AbstractTest.php";s:4:"a567";s:26:"tests/Bag/CategoryTest.php";s:4:"84f0";s:23:"tests/Bag/EventTest.php";s:4:"cd70";s:27:"tests/Bag/OrganizerTest.php";s:4:"d51d";s:25:"tests/Bag/SpeakerTest.php";s:4:"9b7c";s:33:"tests/BagBuilder/AbstractTest.php";s:4:"5ee5";s:33:"tests/BagBuilder/CategoryTest.php";s:4:"dbb6";s:30:"tests/BagBuilder/EventTest.php";s:4:"97ab";s:34:"tests/BagBuilder/OrganizerTest.php";s:4:"868e";s:37:"tests/BagBuilder/RegistrationTest.php";s:4:"4ab8";s:32:"tests/BagBuilder/SpeakerTest.php";s:4:"5e66";s:35:"tests/FrontEnd/CategoryListTest.php";s:4:"43ad";s:32:"tests/FrontEnd/CountdownTest.php";s:4:"18c4";s:40:"tests/FrontEnd/DefaultControllerTest.php";s:4:"7c62";s:29:"tests/FrontEnd/EditorTest.php";s:4:"2e29";s:34:"tests/FrontEnd/EventEditorTest.php";s:4:"3eee";s:36:"tests/FrontEnd/EventHeadlineTest.php";s:4:"e0d2";s:35:"tests/FrontEnd/PublishEventTest.php";s:4:"ac71";s:39:"tests/FrontEnd/RegistrationFormTest.php";s:4:"5b0d";s:40:"tests/FrontEnd/RegistrationsListTest.php";s:4:"ac55";s:39:"tests/FrontEnd/RequirementsListTest.php";s:4:"c6fc";s:37:"tests/FrontEnd/SelectorWidgetTest.php";s:4:"4290";s:34:"tests/FrontEnd/TestingViewTest.php";s:4:"9590";s:37:"tests/Mapper/BackEndUserGroupTest.php";s:4:"e22c";s:32:"tests/Mapper/BackEndUserTest.php";s:4:"63c5";s:29:"tests/Mapper/CategoryTest.php";s:4:"6510";s:29:"tests/Mapper/CheckboxTest.php";s:4:"3f44";s:30:"tests/Mapper/EventDateTest.php";s:4:"d547";s:26:"tests/Mapper/EventTest.php";s:4:"743f";s:31:"tests/Mapper/EventTopicTest.php";s:4:"185f";s:30:"tests/Mapper/EventTypeTest.php";s:4:"c240";s:25:"tests/Mapper/FoodTest.php";s:4:"7601";s:38:"tests/Mapper/FrontEndUserGroupTest.php";s:4:"ddaa";s:33:"tests/Mapper/FrontEndUserTest.php";s:4:"9e61";s:28:"tests/Mapper/LodgingTest.php";s:4:"3289";s:30:"tests/Mapper/OrganizerTest.php";s:4:"b7cb";s:34:"tests/Mapper/PaymentMethodTest.php";s:4:"fa2e";s:26:"tests/Mapper/PlaceTest.php";s:4:"cdd7";s:33:"tests/Mapper/RegistrationTest.php";s:4:"0a2c";s:32:"tests/Mapper/SingleEventTest.php";s:4:"d538";s:26:"tests/Mapper/SkillTest.php";s:4:"d745";s:28:"tests/Mapper/SpeakerTest.php";s:4:"ae2e";s:32:"tests/Mapper/TargetGroupTest.php";s:4:"14e4";s:29:"tests/Mapper/TimeSlotTest.php";s:4:"30af";s:36:"tests/Model/AbstractTimeSpanTest.php";s:4:"8084";s:36:"tests/Model/BackEndUserGroupTest.php";s:4:"6cde";s:31:"tests/Model/BackEndUserTest.php";s:4:"fc85";s:28:"tests/Model/CategoryTest.php";s:4:"edf7";s:28:"tests/Model/CheckboxTest.php";s:4:"9e19";s:29:"tests/Model/EventDateTest.php";s:4:"34c1";s:25:"tests/Model/EventTest.php";s:4:"4ee9";s:30:"tests/Model/EventTopicTest.php";s:4:"3726";s:29:"tests/Model/EventTypeTest.php";s:4:"6cd7";s:24:"tests/Model/FoodTest.php";s:4:"cea4";s:37:"tests/Model/FrontEndUserGroupTest.php";s:4:"0601";s:32:"tests/Model/FrontEndUserTest.php";s:4:"7186";s:27:"tests/Model/LodgingTest.php";s:4:"da9f";s:29:"tests/Model/OrganizerTest.php";s:4:"da6b";s:33:"tests/Model/PaymentMethodTest.php";s:4:"0e00";s:25:"tests/Model/PlaceTest.php";s:4:"d185";s:32:"tests/Model/RegistrationTest.php";s:4:"407c";s:31:"tests/Model/SingleEventTest.php";s:4:"a508";s:25:"tests/Model/SkillTest.php";s:4:"e8c0";s:27:"tests/Model/SpeakerTest.php";s:4:"6716";s:31:"tests/Model/TargetGroupTest.php";s:4:"bdb1";s:28:"tests/Model/TimeSlotTest.php";s:4:"9304";s:31:"tests/OldModel/AbstractTest.php";s:4:"22a1";s:31:"tests/OldModel/CategoryTest.php";s:4:"f7dd";s:28:"tests/OldModel/EventTest.php";s:4:"9e84";s:32:"tests/OldModel/OrganizerTest.php";s:4:"7a1c";s:35:"tests/OldModel/RegistrationTest.php";s:4:"b8cd";s:30:"tests/OldModel/SpeakerTest.php";s:4:"38cf";s:31:"tests/OldModel/TimeSlotTest.php";s:4:"8917";s:31:"tests/OldModel/TimespanTest.php";s:4:"631f";s:37:"tests/Service/EMailSalutationTest.php";s:4:"017a";s:41:"tests/Service/RegistrationManagerTest.php";s:4:"4d09";s:43:"tests/Service/SingleViewLinkBuilderTest.php";s:4:"8301";s:45:"tests/ViewHelper/CommaSeparatedTitlesTest.php";s:4:"e159";s:34:"tests/ViewHelper/CountdownTest.php";s:4:"86b1";s:34:"tests/ViewHelper/DateRangeTest.php";s:4:"6b22";s:34:"tests/ViewHelper/TimeRangeTest.php";s:4:"cba0";s:30:"tests/cli/MailNotifierTest.php";s:4:"dc12";s:54:"tests/fixtures/class.tx_seminars_registrationchild.php";s:4:"7195";s:49:"tests/fixtures/class.tx_seminars_seminarchild.php";s:4:"37e9";s:67:"tests/fixtures/class.tx_seminars_tests_fixtures_TestingTimeSpan.php";s:4:"82b5";s:50:"tests/fixtures/class.tx_seminars_timeslotchild.php";s:4:"a8d1";s:50:"tests/fixtures/class.tx_seminars_timespanchild.php";s:4:"60bb";s:28:"tests/fixtures/locallang.xml";s:4:"182e";s:47:"tests/fixtures/BackEnd/TestingEventMailForm.php";s:4:"17aa";s:45:"tests/fixtures/BackEndExtJs/TestingModule.php";s:4:"06b1";s:56:"tests/fixtures/BackEndExtJs/Ajax/TestingAbstractList.php";s:4:"9ea1";s:54:"tests/fixtures/BackEndExtJs/Ajax/TestingEventsList.php";s:4:"07ac";s:58:"tests/fixtures/BackEndExtJs/Ajax/TestingOrganizersList.php";s:4:"264d";s:61:"tests/fixtures/BackEndExtJs/Ajax/TestingRegistrationsList.php";s:4:"9d78";s:56:"tests/fixtures/BackEndExtJs/Ajax/TestingSpeakersList.php";s:4:"0d09";s:30:"tests/fixtures/Bag/Testing.php";s:4:"33af";s:43:"tests/fixtures/BagBuilder/BrokenTesting.php";s:4:"f61c";s:37:"tests/fixtures/BagBuilder/Testing.php";s:4:"1acf";s:39:"tests/fixtures/FrontEnd/TestingView.php";s:4:"b479";s:43:"tests/fixtures/Model/TitledTestingModel.php";s:4:"943d";s:45:"tests/fixtures/Model/UntitledTestingModel.php";s:4:"3885";s:35:"tests/fixtures/OldModel/Testing.php";s:4:"4088";s:55:"tests/fixtures/Service/TestingSingleViewLinkBuilder.php";s:4:"aac2";s:21:"tests/pi2/pi2Test.php";s:4:"89ea";}',
	'constraints' => array(
		'depends' => array(
			'php' => '5.3.0-0.0.0',
			'typo3' => '4.5.0-4.7.99',
			'cms' => '',
			'css_styled_content' => '',
			'oelib' => '0.7.67-',
			'ameos_formidable' => '1.1.0-1.9.99',
			'static_info_tables' => '2.1.0-',
			'static_info_tables_taxes' => '',
		),
		'conflicts' => array(
			'dbal' => '',
			'sourceopt' => '',
		),
		'suggests' => array(
			'onetimeaccount' => '',
			'sr_feuser_register' => '',
		),
	),
	'suggests' => array(
	),
);

?>