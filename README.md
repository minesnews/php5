# Основы PHP

## Домашнее задание № 5.

Добавьте к шаблону подключение файлов стилей так, чтобы в дальнейшем можно было дорабатывать внешний вид системы.

Сформируйте еще три подключаемых к скелету блока – шапку сайта (она всегда будет одинаковой по стилю и располагаться в самой верхней части), подвал сайта (также одинаковый, но в нижней части) и sidebar (боковая колонка, которую можно наполнять новыми элементами).

Средствами TWIG выводите на экран текущее время.

Создайте обработку страницы ошибки. Например, если контроллер на найден, то нужно вызывать специальный метод рендеринга, который сформирует специальную страницу ошибок.

Для страницы ошибок формируйте HTTP-ответ 404. Это можно сделать при помощи функции header.

### Решение:

Добавили файл стилей в папку Views (файл style.css) и добавили в код main.twig строчки для отображения стилей:

```
<head>
        <title>{{ title }}</title>
        <style>{{ style }}</style>
        <link href="style.css" rel="stylesheet" >
    </head>

```

Добавили файлы header.twig, footer.twig и в файл header.twig добавили сайдбар

В файл main.twig добавили показ текущего времени:

```
Текущая дата: {{ "now"|date("m/d/Y") }}
```

Обработка ошибок: 

В файл Application.php в условия добавили код для обработки ошибок и 404

```
if(method_exists($this->controllerName, $this->methodName)){
                $controllerInstance = new $this->controllerName();
                //$method = $this->methodName;
                //return $controllerInstance->$method();
                return call_user_func_array(
                    [$controllerInstance, $this->methodName],
                    []
                );
            }
            else {
                $controllerInstance = new ErrorController();
                return $controllerInstance -> classNoFound($this->methodName);
            }
        }
        else{
                $controllerInstance = new ErrorController();
                return $controllerInstance -> classNoFound($this->controllerName);
```

Добавили файл ErrorController:

```
<?php

namespace Geekbrains\Application1\Controllers;
use Geekbrains\Application1\Render;

class ErrorController{
    public function metodNoFound($methodName){
        $render404 = new Render();
        header($_SERVER["SERVER_PROTOCOL"]." 404");
        return $render404->renderPage('error.twig', ['methodName' => $methodName]);
    }

    public function classNoFound($controllerName){
        $render404 = new Render();
        header($_SERVER["SERVER_PROTOCOL"]." 404");
        return $render404->renderPage('error404.twig', ['controllerName' => $controllerName]);
    }
}
```

И сделали 2 страницы с ошибками error404.twig и error.twig

```
<h1>404 ошибка - страница не найдена</h1>
```

```
<h1>Метод не найден</h1>
```



