<?php

namespace Dictionary;

class WordsController
{

    /**
     * @SWG\Get(
     *     path="/words",
     *     description="Returns all words from the system that the user has access to",
     *     operationId="findWords",
     *     produces={"application/json", "application/xml", "text/xml", "text/html"},
     *     @SWG\Parameter(
     *         name="limit",
     *         in="query",
     *         description="maximum number of results to return",
     *         required=false,
     *         type="integer",
     *         format="int32"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="word response",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/word")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response="default",
     *         description="unexpected error",
     *         @SWG\Schema(
     *             ref="#/definitions/errorModel"
     *         )
     *     )
     * )
     */
    public function findWords()
    {
    }

    /**
     * @SWG\Get(
     *     path="/words/{id}",
     *     description="Returns a word based on a single ID",
     *     operationId="findWordById",
     *     @SWG\Parameter(
     *         description="ID of word to fetch",
     *         format="int64",
     *         in="path",
     *         name="id",
     *         required=true,
     *         type="integer"
     *     ),
     *     produces={
     *         "application/json",
     *         "application/xml",
     *         "text/html",
     *         "text/xml"
     *     },
     *     @SWG\Response(
     *         response=200,
     *         description="word response",
     *         @SWG\Schema(ref="#/definitions/word")
     *     ),
     *     @SWG\Response(
     *         response="default",
     *         description="unexpected error",
     *         @SWG\Schema(ref="#/definitions/errorModel")
     *     )
     * )
     */
    public function findWordById()
    {
    }

    /**
     * @SWG\Get(
     *     path="/words/{word}",
     *     description="Returns all words that matches the query",
     *     operationId="findWord",
     *     @SWG\Parameter(
     *         description="word to find",
     *         in="path",
     *         name="word",
     *         required=true,
     *         type="string"
     *     ),
     *     produces={
     *         "application/json",
     *         "application/xml",
     *         "text/html",
     *         "text/xml"
     *     },
     *     @SWG\Response(
     *         response=200,
     *         description="word response",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/word")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response="default",
     *         description="unexpected error",
     *         @SWG\Schema(
     *             ref="#/definitions/errorModel"
     *         )
     *     )
     * )
     */
    public function findWord()
    {
    }

    /**
     * @SWG\Post(
     *     path="/word",
     *     operationId="addWord",
     *     description="Creates a new word in the database.  Duplicates are allowed",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="word",
     *         in="body",
     *         description="word to add to the store",
     *         required=true,
     *         @SWG\Schema(ref="#/definitions/wordInput"),
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="word response",
     *         @SWG\Schema(ref="#/definitions/word")
     *     ),
     *     @SWG\Response(
     *         response="default",
     *         description="unexpected error",
     *         @SWG\Schema(ref="#/definitions/errorModel")
     *     )
     * )
     * @SWG\Definition(
     *     definition="wordInput",
     *     allOf={
     *         @SWG\Schema(ref="word"),
     *         @SWG\Schema(
     *             required={"name"},
     *             @SWG\Property(
     *                 property="id",
     *                 type="integer",
     *                 format="int64"
     *             )
     *         )
     *     }
     * )
     */
    public function addWord()
    {
    }

    /**
     * @SWG\Delete(
     *     path="/word/{id}",
     *     description="deletes a single word based on the ID supplied",
     *     operationId="deleteWord",
     *     @SWG\Parameter(
     *         description="ID of word to delete",
     *         format="int64",
     *         in="path",
     *         name="id",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Response(
     *         response=204,
     *         description="word deleted"
     *     ),
     *     @SWG\Response(
     *         response="default",
     *         description="unexpected error",
     *         @SWG\Schema(ref="#/definitions/errorModel")
     *     )
     * )
     */
    public function deleteWord()
    {
    }
}
