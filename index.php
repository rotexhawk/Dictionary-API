<?php
require 'vendor/autoload.php';
require 'DB_Creds.php';
$app = new \Slim\Slim();
$app->config('debug', true);



/* Routes */
$app->get('/', function(){
    echo 'Home - My Slim Application';
});

// Define app routes
$app->get('/hello/{name}', function ($request, $response, $args) {
    return $response->write("Hello " . $args['name']);
});

// Get all words
$app->get('/words', function() use($app, $db){
    $words = array();
    $limit = $app->request()->get();
    $count = 0;
    foreach ($db->words() as $word){
            if ($limit && $count < $limit['limit']){
                $words[] = array(
                "id" => $word["id"],
                "word" => $word["word"],
                "meaning" => $word["meaning"]
                );
                $count++;
            }
        else if (!$limit){
            $words[] = array(
                "id" => $word["id"],
                "word" => $word["word"],
                "meaning" => $word["meaning"]
            );
        }
    }
    $app->response()->header("Content-Type", "application/json");
    echo json_encode($words, JSON_FORCE_OBJECT);
});

// Get word by id
$app->get('/words/:id', function($id) use ($app, $db) {
    $app->response()->header("Content-Type", "application/json");
    $word = $db->words()->where('id',$id);
    if($data = $word->fetch()){
        echo json_encode(array(
            'id' => $data['id'],
            'word' => $data['word'],
            'meaning' => $data['meaning']
        ));
    }
    else{
        $app->response->setStatus(204);
        echo json_encode(array(
            'status' => false,
            'message' => "Word ID $id does not exist"
        ));
    }
})->conditions(['id' => '[0-9]+']);

// get all words matching queryWord
$app->get('/words/:word', function($word) use ($app,$db){
     $app->response()->header("Content-Type", "application/json");
     $words = $db->words()->where('word',$word);
     $wordsArray = array();
     foreach($words as $word){
         $wordsArray[] =  array(
             "id" => $word["id"],
             "word" => $word["word"],
             "meaning" => $word["meaning"]
         );
     }
    echo json_encode($wordsArray, JSON_FORCE_OBJECT);
});


// add new word works with both json and form data
$app->post('/word', function() use($app, $db){
    $app->response()->header("Content-Type", "application/json");
    $word = $app->request->post();
    if (!$word){
        $word = $app->request()->getBody();
        $word = json_decode($word, true);
    }
    $result = $db->words()->insert($word);
    echo json_encode(array("id" => $result["id"]));
});


// update word by id
$app->put('/word/:id', function($id) use($app, $db){
    $app->response()->header("Content-Type", "application/json");
    $word = $db->words()->where("id", $id);
    if ($word->fetch()) {
        $post = $app->request()->put();
        $result = $word->update($post);
        if ($result){
        echo json_encode(array(
            "status" => (bool)$result,
            "message" => "Word updated successfully",
        ));
        }
        else {
            echo json_encode(array(
                "status" => (bool)$result,
                "message" => "Something wrong with the syntax",
            ));
        }
    }
    else{
        echo json_encode(array(
            "status" => false,
            "message" => "Word id $id does not exist"
        ));
    }
});

// delete word by id
$app->delete('/word/:id', function($id) use($app, $db){
    $app->response()->header("Content-Type", "application/json");
    $word = $db->words()->where("id", $id);
    if($word->fetch()){
        $result = $word->delete();
        if ($result){
            echo json_encode(array(
               "status" => true,
                "message" => "Word id $id is sucessfully deleted"
            ));
        }
        else{
            json_encode(array(
                "status" => false,
                "message" => "Word id $id doesn't exist"
            ));
        }
    }
});
/**
 *
 *  This method gets 10 random words from the database that aren't verified.
 *  Every time a word is retrieved the number of revision is incremented by one.
 *  Get 10 words randomly with the smallest number of revisions.
 *  Random range between 0 - length of word table
 *  Random words based on date -- Not implemented yet
 *  Random based on importance scale 1 - 10
 */
$app->get('/wordofday', function() use($app,$db){
    $app->response()->header("Content-Type", "application/json");
    date_default_timezone_set('Asia/Kabul');

    $maxRevision = $db->words()->where("verified",0)->max("revision");
    $minRevision = $db->words()->where("verified",0)->min('revision');

    $wordArray = array();

    // get words with least revision
    for ($j = $minRevision; $j <= $maxRevision; $j++) {
            // get the highest important words
            for ($n = 10; $n >= 0; $n--) {
                $data = $db->words()->where('importance',$n)->where('revision',$j);
                $result = array_map('iterator_to_array', iterator_to_array($data));

                if (sizeof($result) != 0){
                $result = array_combine(range(0,count($result)-1),array_values($result));
                }
                if (sizeof($wordArray) >= 10) {
                    break 2;
                }
                if (sizeof($result) >= 10) {
                    $wordArray = array_merge($wordArray,$result);
                    break 2;
                }
                else{
                   for ($i = 0; $i < sizeof($result); $i++){
                       $wordArray[] = $result[$i];
                   }
                }
            }
    }

    $wordOfDay = array();
    $uniqueKeys = UniqueRandomNumbersWithinRange(0,sizeof($wordArray)-1,10);
    foreach ($uniqueKeys as $key){
        $wordOfDay [] = $wordArray[$key];
        $wordArray[$key]['revision'] = $wordArray[$key]['revision'] + 1;
        $db->words()->where('id',$wordArray[$key]['id'])->update($wordArray[$key]);
    }
    echo json_encode($wordOfDay,JSON_FORCE_OBJECT);
});

function UniqueRandomNumbersWithinRange($min, $max, $quantity) {
    $numbers = range($min, $max);
    shuffle($numbers);
    return array_slice($numbers, 0, $quantity);
}

$app->get('/updateWords', function() use($app,$db) {
       $words = $db->words();

        foreach($words as $word){
            $wordJson = json_encode($word);
            $wordArray = json_decode($wordJson,JSON_FORCE_OBJECT);
            $wordArray['verified'] = rand(0,1);
            $wordArray['revision'] = rand(0,10);
            $wordArray['importance'] = rand(1,10);
            $word->update($wordArray);
        }
});


// Run app
$app->run();
