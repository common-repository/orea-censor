=== Orea敏感词处理系统 ===
Contributors: reage 
Donate link:https://me.alipay.com/reage
Tags: censor,filter
Requires at least: 3.0
Tested up to: 3.6
Stable tag: 1.1
License: GPLv2 or later

Orea敏感词处理系统是一款高效、准确的敏感词处理程序，能够让您的博客远离敏感内容的打扰。

== Description ==

Orea敏感词处理系统(wp)通过调用Orea Open API，将内容post至Orea Cloud Open Platform上，服务器处理完后，反馈回的信息将呈现于博客页面，不知不觉中完成内容审核任务。

Orea Censor has to post the contents to Orea Cloud Open Platform, so the plugin can filter some illegal words.

== Installation ==

Extract the zip file and just drop the contents in the wp-content/plugins/ directory of your WordPress installation and then activate the Plugin from Plugins page.
== Frequently Asked Questions ==

常见错误及其处理方法请参见<a href=\"http://orea.daruisoft.com/index.php?p=2\">http://orea.daruisoft.com/index.php?p=2</a>或者<a href=\"http://www.daruisoft.com/index.php/archives/category/support\">http://www.daruisoft.com/index.php/archives/category/support</a>

== Changelog ==

= 1.0 =
* 用户可以在控制面板设置ID和key
= 1.1 =
* 用户可以修改ID和Key
* hook了content_save_pre钩子，使Orea能过滤一切写向数据库的内容
* 更改了Agent，便于分析