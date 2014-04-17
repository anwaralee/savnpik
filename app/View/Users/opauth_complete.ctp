<h2>Opauth callback:</h2>

<p>
	
<p>User Id:<?php echo $opauth_data['auth']['uid'];?> </p>
<p>Facebook username:<?php echo $opauth_data['auth']['info']['nickname'];?> </p>
<p>User Token:<?php echo $opauth_data['auth']['credentials']['token'];?> </p>
<pre>
	<?php print_r($opauth_data); ?>
</pre>
</p>
