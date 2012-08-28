<?php
  class LintYiiUnitTest extends CTestCase
  {

    public $matchStringNoErrors = 'No syntax errors detected';
    public $outputErrorMsgPrefix = 'Syntax Errors Found In ';

    public function setup()
	  {
      $declaredClasses = get_declared_classes();
      parent::setup();
    }
    
    public function testControllersForErrors()
    {
      $controllers = $this->getClassList('controller');
      foreach($controllers as $controller)
      {
        $results = $this->checkClassForErrors($controller);
        $this->assertTrue(strpos($results[0], $this->matchStringNoErrors) !== false, $this->outputErrorMsgPrefix . basename($controller . ".php") . ":\n" . implode("\n", $results) );
      }
    }

    public function testModelsForErrors()
    {
      $models = $this->getClassList('model');
      foreach($models as $model)
      {
        $results = $this->checkClassForErrors($model);
        $this->assertTrue(strpos($results[0], $this->matchStringNoErrors) !== false, $this->outputErrorMsgPrefix . basename($model . ".php") . ":\n" . implode("\n", $results) );
      }
    }

    public function testComponentsForErrors()
    {
      $components = $this->getClassList('component');

      foreach (glob(Yii::getPathOfAlias("application.components") . "/*" . ".php") as $component)
      {
        $results = $this->checkClassForErrors($component);
        $this->assertTrue(strpos($results[0], $this->matchStringNoErrors) !== false, $this->outputErrorMsgPrefix . basename($component . ".php") . ":\n" . implode("\n", $results) );
      }
    }

    public function testBehaviorsForErrors()
    {
      $behaviors = $this->getClassList('behavior');
      foreach($behaviors as $behavior)
      {
        $results = $this->checkClassForErrors($behavior);
        $this->assertTrue(strpos($results[0], $this->matchStringNoErrors) !== false, $this->outputErrorMsgPrefix . basename($behavior . ".php") . ":\n" . implode("\n", $results) );
      }
    }

    public function testCommandsForErrors()
    {
      $commands = $this->getClassList('command');
      foreach($commands as $command)
      {
        $results = $this->checkClassForErrors($command);
        $this->assertTrue(strpos($results[0], $this->matchStringNoErrors) !== false, $this->outputErrorMsgPrefix . basename($command . ".php") . ":\n" . implode("\n", $results) );
      }
    }


    public function testViewsForErrors()
    {
      exec('pwd', $path);
      $path = explode('protected/', $path[0]);
      $viewsPath = $path[0] . 'protected/views';
      exec("ls $viewsPath", $viewFolders);
      foreach($viewFolders as $viewFolder)
      {
        exec("ls $viewsPath/$viewFolder/ | grep php", $views);
        foreach($views as $view)
        {
          $results = $this->checkClassForErrors("$viewsPath/$viewFolder/$view");
          $this->assertTrue(strpos($results[0], $this->matchStringNoErrors) !== false, $this->outputErrorMsgPrefix . "$viewsPath/$viewFolder/$view" . ":\n" . implode("\n", $results) );
        }
        unset($views);
      }
    }

    public function checkClassForErrors($classPath)
    {
      exec("php -l $classPath", $results);
      return $results;
    }

    public function getClassList($type)
    {
      $classList = array();
      foreach (glob(Yii::getPathOfAlias("application.$type" . 's') . "/*" . ucfirst($type) . ".php") as $class)
      {
        $classList[] =  $class;
      }
      return $classList;
    }
    
  }

?>