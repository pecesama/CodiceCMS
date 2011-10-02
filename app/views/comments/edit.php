
<div class="row">
    <div class="span12">
		<?php echo $this->html->form("comments/edit/".$id."/"); ?>
			<div class="clearfix">
				<div class="input">
					<p><strong>IP</strong> <?php echo $comment["IP"]; ?></p>
					<p><strong>created</strong>	<?php echo $comment["created"]; ?></p>
					<p><strong>modified</strong> <?php echo $comment["modified"]; ?></p>
				</div>
			</div>

			<div class="clearfix">
				<label for="status">Publishing status</label>
				<div class="input">
					<?php echo $this->html->select("status", $statuses, $comment["status"]); ?>
				</div>
			</div>

			<div class="clearfix">
				<label for="author">Comment author</label>
				<div class="input">
					<?php echo $this->html->textField("author"," value=\"{$comment["author"]}\" class='xlarge'");?>
				</div>
			</div>

			<div class="clearfix">
				<label for="email">Email</label>
				<div class="input">
					<?php echo $this->html->textField("email"," value=\"{$comment["email"]}\"");?>
				</div>
			</div>

			<div class="clearfix">
				<label for="url">Web page</label>
				<div class="input">
					<?php echo $this->html->textField("url"," value=\"{$comment["url"]}\" class='xlarge'");?>
				</div>
			</div>

			<div class="clearfix">
            	<div class="input">
              		<ul class="inputs-list">
                		<li>
                			<label>
                				<?php $checked = $comment["suscribe"]?"checked=\"true\"":""; ?>
								<?php echo $this->html->checkbox("suscribe",$checked);?> Suscribed to comments.</span>
                  			</label>
                		</li>
                	</ul>
                </div>
            </div>

            <div class="clearfix">
				<label>View post</label>
				<div class="input">
					<?php echo $this->html->linkTo("Go to: {$comment["post"]["title"]}", $comment["post"]["urlfriendly"]."/", " title=\"View posst\" target=\"_blank\" class='btn'"); ?>
				</div>
			</div>

			<div class="clearfix">
				<label for="content">Entry content</label>
				<div class="input">
				<?php echo $this->html->textArea("content", $comment["content"], " rows=\"3\" class='xxlarge' "); ?>
				</div>
			</div>

			<div class="actions">
				<input class="btn" id="cancelar" name="cancelar" type="submit" value="Cancel">
				<input class="btn danger" type="submit" value="Save changes" />
			</div>
		</form>
	</div>
</div>

<?php echo $this->renderElement("admin_footer"); ?>
