<div class="table_HasBeenJudge">
    <?php

        $qHasBeenJudge["All"] = $bdd->query('SELECT * FROM competitors, penalty WHERE competitors.number = penalty.competitor_number AND EXISTS (SELECT * FROM competitors WHERE competitors.number = penalty.competitor_number) ORDER BY penalty.gate_number, penalty.id');
        $countHasBeenJudge["All"] = $qHasBeenJudge["All"] ->rowCount();

        if ($countHasBeenJudge == 0){
            echo "<h2>Ont été jugé: 0</h2>";
        }else {
            echo "<h2>Ont été jugé:</h2>";
        ?>            
            <table>
                <div class="TR_HasBeenJudge">
                    </TR>
                        <TH>Dossard</TH>
                        <TH>Nom Prénom</TH>
                        <TH>Club</TH>
                        <TH colspan="2" >Pénalitées</TH>
                    </TR>
                </div>            

    <?php
        }

        foreach ($user_gates as $gate) {
            echo "
            </TR>
                <TH colspan=\"7\" > Portes: $gate</TH>
            </TR>";

            $sqlHasBeenJudgeGate = "
            SELECT *
            FROM   competitors,
                penalty
            WHERE  competitors.number = penalty.competitor_number
                AND EXISTS (SELECT *
                            FROM   competitors
                            WHERE  competitors.number = penalty.competitor_number
                                    AND penalty.gate_number = :gate)
            ORDER  BY penalty.gate_number,
                    penalty.id";


            $qHasBeenJudge[$gate] = $bdd->prepare($sqlHasBeenJudgeGate);
            $qHasBeenJudge[$gate]->execute(array(':gate' => $gate));
            $countHasBeenJudge[$gate] = $qHasBeenJudge[$gate] ->rowCount();

        foreach ($qHasBeenJudge[$gate] as $dataHasBeenJudge) {
    ?>

    <div class="InitData_HasBeenJudge">
        <?php
        //Extraction et affectation des variables
        // Stocke $data[firstname] dans une variable temporaire
        $TfirstnameHasBeenJudge = $dataHasBeenJudge['firstname'];
        // Stocke toutes la lettres sauf la 1ere dans une variable temporaire
        $TrestHasBeenJudge = substr($TfirstnameHasBeenJudge, 1);
        //LowerCase de $Trest en $rest
        $restHasBeenJudge = strtolower($TrestHasBeenJudge);
        //UpCase de $Tfirstname en $firstname
        $firstnameHasBeenJudge = strtoupper($TfirstnameHasBeenJudge);
        //UpCase de $data[name] en $name
        $nameHasBeenJudge = strtoupper($dataHasBeenJudge['name']);
        // Stocke $data[club_abrev] dans une variable temporaire
        $Tclub_abrevHasBeenJudge = $dataHasBeenJudge['club_abrev'];
        //UpCase de $Tclub_abrev en $club_abrev
        $club_abrevHasBeenJudge = strtoupper($Tclub_abrevHasBeenJudge);
        $penaltyidHasBeenJudge = $dataHasBeenJudge['id'];
        ?>
    </div>

    <div class="Dossard_HasBeenJudge">
        <?php
        //Dossard = $data[number]
        echo "</TR> <form method=\"GET\" action=\"\">";
        echo "
            <TD>
            <input type=\"checkbox\" name=\"number\" class=\"dossard-button\" id=\"checkbox\" value=\"$dataHasBeenJudge[number]\" checked>
            <label for=\"checkbox\">$dataHasBeenJudge[number]</label>
            </TD>  
            ";
        ?>
    </div>        
    
    <div class="Nom_Prenom_HasBeenJudge">
        <?php
        //"Nom Prénom"=  $name $firstname[0]$rest
        echo "<TD> $nameHasBeenJudge $firstnameHasBeenJudge[0]$restHasBeenJudge </TD>";
        ?>
    </div>

    <div class="Club_HasBeenJudge">
        <?php
        //Club = $club_abrev
        echo "<TD> $club_abrevHasBeenJudge </TD>";
        ?>
    </div>
        
    <div class="Submit_HasBeenJudge">
        <?php

        //Start = <input type="Submit">
            echo "
            <TD>
            
            <p> $dataHasBeenJudge[penalty_amount] <p/>

            <!--//*! Fail de sécurité si tu modifie l'input 'penalty_id' tu remove n'imp quel pénalitées--!>
            <input type=\"text\" readonly=\"readonly\" name=\"penalty_id\" value=\"$dataHasBeenJudge[id]\" style=\"display: none;\" />
            </TD>

            <TD>

            <input id=\"reverse$penaltyidHasBeenJudge\".\"_\".\"$dataHasBeenJudge[number]\" type=\"submit\" name=\"reverse\" value=\"1\">
            <label for=\"reverse$penaltyidHasBeenJudge\".\"_\".\"$dataHasBeenJudge[number]\">Annuler</label>

            </TD>

            </form>
            ";

        ?>
    </div>
        
    <?php
    echo "</TR>";  
    }
    }
  ?>
    <table/>
</div>