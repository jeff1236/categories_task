<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Task.php";
    require_once "src/Category.php";

    $server = 'mysql:host=localhost;dbname=to_do_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class TaskTest extends PHPUnit_Framework_TestCase
    {

    protected function tearDown()
        {
            Task::deleteAll();
        }

    function test_getId()
    {
        //Arrange
        $name = "Home stuff";
        $id = null;
        $test_category = new Category($name, $id);

        $test_category->save();

        $description = "Wash the dog";
        $category_id = $test_category->getId();
        $date = "2015-08-21";
        $test_task = new Task($description, $id, $category_id, $date);
        $test_task->save();

        //Act
        $result = $test_task->getId();

        //Assert
        $this->assertEquals(true, is_numeric($result));
    }

    function test_getCategoryId()
    {
        //Arrange
        $name = "Home stuff";
        $id = null;
        $test_category = new Category($name, $id);
        $test_category->save();
        $description = "Wash the dog";
        $category_id = $test_category->getId();
        $date = "2015-08-22";
        $test_task = new Task($description, $id, $category_id, $date);
        $test_task->save();

        //Act
        $result = $test_task->getCategoryId();

        //Assert
        $this->assertEquals(true, is_numeric($result));
    }

    function test_save()
    {
        //Arrange
        $name = "Home stuff";
        $id = null;
        $test_category = new Category($name, $id);
        $test_category->save();

        $description = "Wash the dog";
        $category_id = $test_category->getId();
        $date = "2015-08-23";
        $test_task = new Task($description, $id, $category_id, $date);

        //Act
        $test_task->save();

        //Assert
        $result = Task::getAll();
        $this->assertEquals($test_task, $result[0]);
    }

    function test_getAll()
    {
        //Arrange
        $name = "Home Stuff";
        $id = null;
        $test_category = new Category ($name, $id);
        $test_category->save();

        $description = "Wash the dog";
        $category_id = $test_category->getId();
        $date = "2015-08-24";
        $test_task = new Task($description, $id, $category_id, $date);
        $test_task->save();

        $description2 = "Water the lawn";
        $test_task2 = new Task($description2, $id, $category_id, $date);
        $test_task2->save();

        //Act
        $result = Task::getAll();

        //Assert
        $this->assertEquals([$test_task, $test_task2], $result);
    }

    function test_deleteAll()
    {
        //Arrange
        $name = "Home stuff";
        $id = null;
        $test_category = new Category($name, $id);
        $test_category->save();

        $description = "Wash the dog";
        $category_id = $test_category->getId();
        $date = "2015-08-25";
        $test_task = new Task($description, $id, $category_id, $date);
        $test_task->save();

        $description2 = "Water the lawn";
        $test_task2 = new Task($description2, $id, $category_id, $date);
        $test_task2->save();

        //Act
        Task::deleteAll();

        //Assert
        $result = Task::getAll();
        $this->assertEquals([], $result);
        }

    function test_find()
    {
        //Arrange
        $name = "Home stuff";
        $id = null;
        $test_category = new Category($name, $id);
        $test_category->save();

        $description = "Wash the dog";
        $category_id = $test_category->getId();
        $date = "2015-08-26";
        $test_task = new Task($description, $id, $category_id, $date);
        $test_task->save();

        $description2 = "Water the lawn";
        $test_task2 = new Task($description2, $id, $category_id, $date);
        $test_task2->save();

        //Act
        $result = Task::find($test_task->getId());

        //Assert
        $this->assertEquals($test_task, $result);
        }

    }
?>
