# todo-api
REST API to manage daily tasks

## Установка ##
1. Установите все зависимости composer.json
2. Импортируйте файл <code>/database.sql</code> в вашу базу данных
3. Создайте <code>/.env</code> файл с настройками приложения (пример можно найти в <code>/.env.example</code>)

## Роуты ##
Пути, с помошью которых можно управлять API

GET /task -   Показать все задачи

GET /task/1 - Показать первую задачу

POST /task -  Создать новою задачу (Пример параметров: {title:Test, description:Test, done:0})

PUT  /task/1 -  Обновить задачу 1  (Пример параметров: {title:Test, description:Test, done:1})

DELETE /task/1 - Удалить задачу 1
