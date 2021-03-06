# TaskChainBundle
With this bundle you can assign your services to a taskchain, which is executable by console.

## Installation
Composer (<a href="https://packagist.org/packages/eschmar/taskchain-bundle" target="_blank">Packagist</a>):
```json
"require": {
	"eschmar/taskchain-bundle": "dev-master"
},
```

app/Appkernel.php:
```php
new Eschmar\TaskChainBundle\EschmarTaskChainBundle(),
```

## Usage

The following demo creates a new Task called `Test Task` which will simply wait 3 seconds before returning. Your service has to extend the provided abstract class `TaskAbstract`.

src/Acme/HelloBundle/Task/TestTask.php:
```php
namespace Acme\HelloBundle\Task;

use Eschmar\TaskChainBundle\Task\TaskAbstract;

class TestTask extends TaskAbstract
{
	protected function init() {
		$this->name = 'Test Task';
		$this->groups[] = 'test';
	}

	public function execute() {
		sleep(3);
		return true;
	}
}
```

src/Acme/HelloBundle/Resources/config/services.yml:
```yaml
acme_hello.taskchain_test:
    class: Acme\HelloBundle\Task\TestTask
    tags:
        - { name: taskchain }
```

Now you can execute the console command:

```shell
php app/console taskchain [<group>] [--inset]
```

The command will execute all tagged services meeting the group requirement. Use the `--inset` option to exclude a group but execute all others.

Output:
```shell
$ app/console taskchain

   ______           __      ________          _
  /_  __/___ ______/ /__   / ____/ /_  ____ _(_)___
   / / / __ `/ ___/ //_/  / /   / __ \/ __ `/ / __ \
  / / / /_/ (__  ) ,<    / /___/ / / / /_/ / / / / /
 /_/  \__,_/____/_/|_|   \____/_/ /_/\__,_/_/_/ /_/

 --------------------------- START ---------------------------

 . Test Task... success

 ---------------------------- END ----------------------------

```

## License

MIT License
