<?php
include '../db/koneksi.php';
include 'function_forum.php';
include 'function_user.php';

$class_id = isset($_GET['class_id']) ? $_GET['class_id'] : 0;
$user = isAuthorized($conn);
$messages = getForumMessages($conn, $class_id);
?>

<div class="d-flex flex-column">
    <?php foreach ($messages as $message): ?>
        <div class="m-3 p-3" style="border: 2px solid gray; border-radius: 24px;">
            <div class="d-flex flex-column">
                <h4><?php echo htmlspecialchars($message['name']); ?></h4>
                <div class="d-flex">
                    <h5 class="flex-grow-1"><?php echo htmlspecialchars($message['message']); ?></h5>
                    <h5><?php echo htmlspecialchars($message['created_at']); ?></h5>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<div class="position-fixed mx-5 mb-5" style="bottom: 0; left: 250px; width: 70%;">
    <form action="action_add_forum_message.php" method="post">
        <input type="hidden" name="class_id" value="<?php echo $class_id; ?>">
        <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
        <div class="input-group mb-3">
            <input type="text" class="form-control border-primary px-3 py-2" name="message" placeholder="Tulis pesan"
                aria-label="Tulis Pesan" aria-describedby="button-addon2">
            <button class="btn btn-primary" type="submit" id="btn-kirim">Button</button>
        </div>
    </form>
</div>