<?php session_destroy();
    echo '<script>
        localStorage.removeItem("token_user");
        window.location = "'.TemplateController::path().'account&login";

      </script>
    ';
