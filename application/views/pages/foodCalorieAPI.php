
<main>

    <h3 class="title">ערכים תזונתיים</h3>

    <div id="mainWrraper">
        <div id="searchWrraper">

            <form action="" method="get">
                <fieldset class="center">
                    <div class="inputWrapper"><label for="query"><b>הזן/י את שם הפריט:</b></label>
                        <input id="query" type="text" name="query" /> </div>
                    <div class="inputWrapper"><input class="submitBtn" name="submit" type="submit" value="הצג ערכים תזונתיים"></div>
                </fieldset>
            </form>
        </div>


        <?php
        $name=filter_input(INPUT_GET, 'query');
        for($i=0;$i<strlen($name);$i++)
        {
            if($name[$i]==" ")
            {
                $name[$i]='-';
            }
        }
        if (filter_input(INPUT_GET, 'query') != null && filter_input(INPUT_GET, 'query') != '') {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://edamam-food-and-grocery-database.p.rapidapi.com/parser?ingr=" . $name,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "x-rapidapi-host: edamam-food-and-grocery-database.p.rapidapi.com",
                    "x-rapidapi-key: 4bf6a33b5fmsh4403b5a9cc0cc54p13b00ejsn45a57fd91e7a"
                ),
            ));

            $response = json_decode(curl_exec($curl), true);
            $err = curl_error($curl);

            curl_close($curl);

        }

        if (!empty($response["hints"])) {
            echo '<center><b>הנתונים שנמצאו:</b></center><br>';
            for ($i = 0; $i < 10; $i++) {
                echo '<div class="itemValuesArea">';
                echo '<h4 class="itemValuesTitle">' . $response["hints"][$i]['food']['label'] . '</h4><br>';
                if (isset($response["hints"][$i]['food']['nutrients']['ENERC_KCAL'])) {
                    echo '<b>קלוריות: </b>' . $response["hints"][$i]['food']['nutrients']['ENERC_KCAL'] . '<br>';
                }
                if (isset($response["hints"][$i]['food']['nutrients']['FAT'])) {
                    echo '<b>שומן: </b>' . $response["hints"][$i]['food']['nutrients']['FAT'] . '<br>';
                }
                if (isset($response["hints"][$i]['food']['image'])) {
                    echo '<img class="itemValiesImg" src="data:image/jpeg;base64,' . base64_encode(file_get_contents($response["hints"][$i]['food']['image'])) . '"/>';
                }
                echo '</div><hr>';
            }
        } else if ($_GET) {
            echo '<b>לא קיימים נתונים במאגר <br> שים לב כי הזנת נתון באנגלית </b>';
        }
        ?>


    </div>
</main>