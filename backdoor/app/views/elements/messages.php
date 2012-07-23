<?php if($this->messages->issetMessages()): ?>
<div id="messages">
    <ul>
    <?php foreach($this->messages->getMessages() as $message): ?>
        <li class="alert-message fade in <?php echo $message['type']; ?>">
            <a class="close" href="#">×</a>
            <?php echo $message['message']; ?>
        </li>
    <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>