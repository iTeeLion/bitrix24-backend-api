# Bitrix24 side processing api

Laravel like api для работы с облачным bitrix24

**Подойдет для:**
- Внешняя обработка данных в облачном bitrix24
- Экспорт данных из bitrix24 во внешнией системы
- etc.

**Как начать работу:**
1. Клонируйте репозиторий в директорию веб хоста
2. Скопируйте файл *.env.example* в *.env* и заполните его необходимыми данными
3. Создайте класс обработчик запроса в директории */App/Controllers*
4. Добавьте путь к методу контроллера в файле роутера */routes.php*
