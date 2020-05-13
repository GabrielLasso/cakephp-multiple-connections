<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Datasource\ConnectionManager;

class PagesController extends AppController
{
    public function test()
    {
        $this->LoadModel("Test");
        $conn1 = ConnectionManager::get('default');
        $conn2 = ConnectionManager::get('db2');

        $this->Test->connection($conn1);
        $test1 = $this->Test->get(0);
        $this->Test->connection($conn2);
        $test2 = $this->Test->get(0);

        $result = [
            "db1" => $test1,
            "db2" => $test2
        ];
        return $this->response->withType("application/json")->withStringBody(json_encode($result));
    }
}
