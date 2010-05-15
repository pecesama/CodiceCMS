<?php header("Content-type: text/xml; charset=utf-8"); ?><rss version="2.0">
	<channel>
		<title><?php echo htmlspecialchars($conf["blog_name"]); ?></title>
		<link><?php echo $conf["blog_siteurl"];?></link>
		<description><?php echo htmlspecialchars($conf["blog_description"]);?></description>
		<generator>CMS</generator>
		<?php foreach ($posts as $post) { ?>
		<item>
			<title><?php echo htmlspecialchars($post["title"]); ?></title>
			<description><![CDATA[<?php echo $post["content"]; ?>]]></description>
			<link><?php echo $this->path; ?><?php echo $post["urlfriendly"]; ?>/</link>
			<guid isPermaLink="true"><?php echo $this->path; ?><?php echo $post["urlfriendly"]; ?>/</guid>
			<pubDate><?php echo date("D, d M Y H:i:s \G\M\T",strtotime($post["created"])); ?></pubDate>
			<category><?php echo htmlspecialchars($post["tags"]); ?></category>
		</item>
		<?php } ?>
	</channel>
</rss>
