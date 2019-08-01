<?php


namespace App\Controllers;


use App\Models\Task;
use App\System\ValidateField;
use App\System\Validator;
use League\Route\Http\Exception\BadRequestException;
use League\Route\Http\Exception\NotFoundException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

class TaskController
{

    public function index(ServerRequestInterface $request)
    {
        $all=\App\Models\Task::all();
        return $all;
    }

    public function store(ServerRequestInterface $request, $args)
    {
        // Validate requested data
        // If validation fails show 400 status code
        // with some explanation
        $validator = new Validator([
            'title' => [
                'required' => null,
                'max' => 255,
            ],
            'description' => [
                'required' => null,
                'max' => 1000,
            ],
            'done' => [
                'boolean' => null,
            ]
        ]);

        // If validation failed
        // Then status code 400 with
        // errors array
        if(!$validator->validate())
        {
            return new JsonResponse(['errors' => $validator->getErrors()], 400);
        }

        $task = Task::create($validator->getValues());

        // Success response

        return new JsonResponse([
            "status_code"=> 201,
            'reason_phrase' => 'Successfully created',
        ], 201);
    }

    public function show(ServerRequestInterface $request, $args)
    {
        // Filter data from URI
        // Handled in Strategy!!!!!
        $id = $this->is_integer($args['id']);

        // Build requested Model using ORM
        $task = Task::find($id);

        // If task wasn't found
        // Status code 404
        if($task === null)
        {
            throw new NotFoundException();
        }

        // Show task
        return $task;
    }

    public function update(ServerRequestInterface $request, $args)
    {
        // Filter requested data
        // Handled in Strategy!!!!!
        $id = $this->is_integer($args['id']);

        // Validate requested data
        // If validation fails show 400 status code
        // with some explanation
        $validator = new Validator([
            'title' => [
                'required' => null,
                'max' => 255,
            ],
            'description' => [
                'required' => null,
                'max' => 1000,
            ],
            'done' => [
                'boolean' => null,
            ]
        ]);

        // If validation failed
        // Then status code 400 with
        // errors array
        if(!$validator->validate())
        {
            return new JsonResponse(['errors' => $validator->getErrors()], 400);
        }

        // Get task
        $task = Task::find($id);

        // If task isn't found
        // Status code 404
        if($task === null)
        {
            // Handled in Strategy!!!!!
            throw new NotFoundException();
        }

        // Update task
        $task = $task->update($validator->getValues());
        return new JsonResponse([
            "status_code"=> 200,
            'reason_phrase' => 'Resource updated successfully',
        ], 200);
    }

    public function destroy(ServerRequestInterface $request, $args)
    {
        // Filter requested data
        // Handled in Strategy!!!!!
        $id = $this->is_integer($args['id']);

        // Get task
        $task = Task::find($id);

        // If task isn't found
        // Status code 404
        if($task === null)
        {
            // Handled in Strategy!!!!!
            throw new NotFoundException();
        }

        // Deleting task
        $task->delete();
        return new JsonResponse([
            "status_code"=> 200,
            'reason_phrase' => 'Resource deleted successfully',
        ], 200);
    }

    function is_integer($element) {
        if(  preg_match ("/[^0-9]/", $element))
        {
            // 404 Error
            throw new NotFoundException();
        }
        return $element;
    }


}