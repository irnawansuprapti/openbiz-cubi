<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{$title}</title>
<meta name="description" content="{$description}"/>
<meta name="keywords" content="{$keywords}"/>
<link rel="stylesheet" href="{$css_url}/general.css" type="text/css" />
<script type='text/javascript' src="/gc06/cubi/js/shortcut.js"></script>
<script type="text/javascript" src="/gc06/cubi/js/cookies.js"></script>
<script type="text/javascript" src="/gc06/cubi/themes/touch/js/general_ui.js"></script>
{$style_sheets}
{$scripts}
</head>

<body>

<!-- Start of application content page 
     this page has menu button to #app_menu_page and home button to #app_tab_page
-->

<!-- Start of application menu page -->
<div data-role="page" id="app_menus_page">
{include file='system_menus.tpl.html'}
</div><!-- /page -->

<!-- Start of application tab/header page -->
<div data-role="page" id="app_tabs_page">
{include file='system_tabs.tpl.html'}
</div><!-- /page -->

</body>
</html>