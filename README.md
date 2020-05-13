# Multiple db connections in a cake php project

## Setting up the databases
First, run `docker-compose up` to run the containers.

Then access the container of the first database by running `docker exec -it cakephp-multiple-connections_db1_1 bash`.

There, enter in mysql by `mysql -pexample` and then:

```
CREATE DATABASE example;
USE example;
CRETATE TABLE test (id INT NOT NULL, number INT NOT NULL, PRIMARY KEY (id));
INSERT INTO table (id, number) VALUES (0,0),(1,2),(2,4),(3,6);
```

To setup the second database do the same thing but in `db2` container and with different data:
- `docker exec -it cakephp-multiple-connections_db2_1 bash`
- `mysql -pexample`
```
CREATE DATABASE example;
USE example;
CRETATE TABLE test (id INT NOT NULL, number INT NOT NULL, PRIMARY KEY (id));
INSERT INTO table (id, number) VALUES (0,1),(1,3),(2,5),(3,7);
```

## Testing
Just access `localhost` and you will see that it gets the first element of db1 (id:0, number:0) and the first element of db2 (id:0, number:1).

## How it works
In `config/app.php`, there are 2 entries for Datasources, the default configured for `db1` and a new one called db2 configured for `db2`.

Then, in the PagesController, there is a connection with "default" and a connection with "db2". To run a query in db2, you need to set the Table's connection to the "db2" connection, by doing
```
    $this->TableName->connection($connectionName);
```
of, if you are inside the Table class, just:
```
    $this->TableName->connection($connection);
```

In the example, we do the following:
```
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
```

## Good pratices
I recommend to, every time you change a connection of a table, you reset it to the default connection, so every time you want to make a query you know where it will be made
