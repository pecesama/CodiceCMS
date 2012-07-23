<div class="clearfix">
    <label for="title">Title</label>
    <div class="input">
        <?php echo $this->html->textField("title", $post['title'],  'class="xlarge" placeholder="title"'); ?>
        <?php echo $this->html->linkTo("?","#"," rel='popover' title='Title' data-content='Description about Title.'"); ?>
    </div>
</div>

<div class="clearfix">
    <label for="urlfriendly">URl friendly</label>
    <div class="input">
        <?php echo $this->html->textField("urlfriendly", $post['urlfriendly'], ' class="xlarge" placeholder="url friendly" ');?>
        <?php echo $this->html->linkTo("?","#"," rel='popover' title='Title' data-content='Description about URL friendly.'"); ?>
    </div>
</div>

<div class="clearfix">
    <label for="content">Content for the entry</label>
    <div class="input">
        <?php echo $this->html->textArea("content", $post['content'], ' rows="3" class="xxlarge" placeholder="content"'); ?>
    </div>
</div>

<div class="clearfix">
    <label for="tags">Labels or Tags</label>
    <div class="input">
        <p>Separate each tag with a space: urban moblog phone. Or to join 2 words in one tag, use double quotes: "daily commute".</p>

        <?php echo $this->html->textField("tags", htmlspecialchars($post["tags"]),' placeholder="tags" class="xlarge" '); ?>
        <?php echo $this->html->linkTo("?","#",' rel="popover" title="Title" data-content="Description about Labels or Tags." '); ?>
    </div>
</div>