<?php
session_start();
session_abort();
?>
<script language="javascript">
    alert('Anda berhasil logout');
    document.location = 'login.php';
</script>