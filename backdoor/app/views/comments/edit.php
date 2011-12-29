
<div class="row">
    <div class="span12">
		<?php echo $this->html->form("comments/edit/".$id."/"); ?>
			<div class="clearfix">
				<div class="input">
					<p><strong>IP</strong> <?php echo $comment["IP"]; ?>
					<?php echo $this->html->linkTo("?","#"," rel='popover' title='Title' data-content='Description about IP.'"); ?></p>
					<p><strong>Created date</strong>	<?php echo $comment["created"]; ?>
					<?php echo $this->html->linkTo("?","#"," rel='popover' title='Title' data-content='Description about Created date.'"); ?></p>
					<p><strong>Modified date</strong> <?php echo $comment["modified"]; ?>
					<?php echo $this->html->linkTo("?","#"," rel='popover' title='Title' data-content='Description about Modified date.'"); ?></p>
				</div>
			</div>

			<div class="clearfix">
				<label for="status">Publishing status</label>
				<div class="input">
					<?php echo $this->html->select("status", $statuses, $comment["status"]); ?>
					<?php echo $this->html->linkTo("?","#"," rel='popover' title='Title' data-content='Description about Publishing status.'"); ?>
				</div>
			</div>

			<div class="clearfix">
				<label for="author">Comment author</label>
				<div class="input">
					<?php echo $this->html->textField("author"," value=\"{$comment["author"]}\" class='xlarge'");?>
					<?php echo $this->html->linkTo("?","#"," rel='popover' title='Title' data-content='Description about Comment author.'"); ?>
				</div>
			</div>

			<div class="clearfix">
				<label for="email">Email</label>
				<div class="input">
					<?php echo $this->html->textField("email"," value=\"{$comment["email"]}\"");?>
					<?php echo $this->html->linkTo("?","#"," rel='popover' title='Title' data-content='Description about Email.'"); ?>
				</div>
			</div>

			<div class="clearfix">
				<label for="url">Web page</label>
				<div class="input">
					<?php echo $this->html->textField("url"," value=\"{$comment["url"]}\" class='xlarge'");?>
					<?php echo $this->html->linkTo("?","#"," rel='popover' title='Title' data-content='Description about Web page.'"); ?>
				</div>
			</div>

			<div class="clearfix">
            	<div class="input">
              		<ul class="inputs-list">
                		<li>
                			<label>
                				<?php $checked = $comment["suscribe"]?"checked=\"true\"":""; ?>
								<?php echo $this->html->checkbox("suscribe",$checked);?> Suscribed to comments.
								<?php echo $this->html->linkTo("?","#"," rel='popover' title='Title' data-content='Description about Sucribing to comments.'"); ?>
                  			</label>

                		</li>
                	</ul>
                </div>
            </div>

            <div class="clearfix">
				<label>View post</label>
				<div class="input">
					<?php echo $this->html->linkTo("Go to: {$comment["post"]["title"]}", $comment["post"]["urlfriendly"]."/", " title=\"View posst\" target=\"_blank\" class='btn'"); ?>
					<?php echo $this->html->linkTo("?","#"," rel='popover' title='Title' data-content='Description about View post.'"); ?>
				</div>
			</div>

			<div class="clearfix">
				<label for="content">Entry content</label>
				<div class="input">
				<?php echo $this->html->textArea("content", $comment["content"], " rows=\"3\" class='xxlarge' "); ?>
				</div>
			</div>

			<div class="actions">
				<input class="btn danger" type="submit" value="Save changes" />
				<?php echo $this->html->linkTo("Cancel","comments","class='btn'");?>
			</div>
		</form>
	</div>
</div>

<?php echo $this->renderElement("admin_footer"); ?>
