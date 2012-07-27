<div class="clearfix">
    <label for="title">Title</label>
    <div class="input">
        <?php echo $this->html->textField("title", $post['title'],  'class="xlarge" placeholder="title"'); ?>
        <?php echo $this->html->linkTo("?","#"," rel='popover' title='Title' data-content='Description about Title.'"); ?>
    </div>
</div>


<div class="clearfix">
    <label for="urlfriendly">Main image</label>
    <div class="input">
        <input type="file" name="mainImage" value="" />
        <span class="help-block">image before: <?php echo $post['mainImage']?$post['mainImage']:$this->l10n->__("no image"); ?></span>
    </div>
</div>

<div class="clearfix">
    <label for="content">Content for the entry</label>
    <div class="input">
        <?php echo $this->html->textArea("content", $post['content'], ' rows="3" class="xxlarge ckeditor" placeholder="content"'); ?>
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

<?php echo $this->html->includeJs("ckeditor_3.6.4/ckeditor"); ?>