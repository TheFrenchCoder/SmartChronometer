<div class="Title">
    <?php
        $message_count_gates = "";
            $first_gate = true;
            $user_gates = $json['judge_gates'][$_SESSION["user_id"]];
            foreach ($user_gates as $gate) {
                        if ($first_gate == false) {
                            $message_count_gates .= ", ";
                        }
                        $message_count_gates .= $gate;
                        $first_gate = false;
                    }
            $message_count_gates .= ")";

        echo "<h1>Juge (portes: $message_count_gates</h1>";
    ?>
</div>