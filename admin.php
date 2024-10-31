<?php
add_action('admin_menu','orea_admin_menu');
function orea_admin_menu(){
	add_plugins_page('Orea Censor Page', 'Orea敏感词处理系统', 'read', '点击配置Orea敏感词处理系统', 'show_orea_admin_menu');
}

function show_orea_admin_menu(){
		$toShow = <<<EOT
<h2>
	Step 1 获得Orea Open API密钥（key）
</h2>
<p>
	<span style="white-space:pre">	</span>根据您的实际需要，您可以到<a href="http://orea.daruisoft.com/apply.php">http://orea.daruisoft.com/apply.php</a>注册一个免费的key（每日的配额是10次），或者您也可以到<a href="http://orea.daruisoft.com/index.php?p=1">http://orea.daruisoft.com/index.php?p=1</a>购买商业授权的key。
</p>
<hr />
<h2>
	Step &nbsp;2 配置您的Orea Open API密钥
</h2>
%setting key%
<hr />
	<h2>
		Orea 错误日志
</h2>
<p>
	%error_log%
</p>
EOT;
	$log = get_error_log();
	$toShow = str_replace('%error_log%', $log, $toShow);
	if (OREA_ID == '%orea_id%' && OREA_KEY == '%orea_key%') {
		$setting_key = <<<EOT
	<form id="form1" name="form1" method="post" action="#">
  ID：
  <label for="id"></label>
  <input type="text" name="id" id="id" />
  <br />
  Key：
  <label for="key"></label>
  <input type="text" name="key" id="key" />
  <br />
  <input type="submit" name="submit" id="submit" value="提交" />
  <input type="reset" name="reset" id="reset" value="重置" />
</form>	
EOT;
	}else{
		$setting_key = <<<EOT
		<span style="font-size:24px;color:#33CC00;"><strong>您已成功配置，填写下面的表单，您能更换您的ID(%id%)和Key
</strong></span>
<form id="form1" name="form1" method="post" action="#">
  ID：
  <label for="id"></label>
  <input type="text" name="id" id="id" />
  <br />
  Key：
  <label for="key"></label>
  <input type="text" name="key" id="key" />
  <br />
  <input type="submit" name="submit" id="submit" value="提交" />
  <input type="reset" name="reset" id="reset" value="重置" />
</form>	
EOT;
	}
	$toShow = str_replace('%id%', OREA_ID, $toShow);
	echo $toShow;
}

function get_error_log() {
	$log = file_get_contents(dirname( __FILE__ ).'/error.log');
	return $log;
}
?>