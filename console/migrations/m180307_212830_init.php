<?php

use yii\db\Migration;

/**
 * Class m180307_212830_init
 */
class m180307_212830_init extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // todo: Создать таблицы ролей и прав и писать сюда ID роли
        $this->createTable('manager', [
            'id' => $this->primaryKey()->unsigned(),
            'role' => $this->string()->defaultValue('operator')->comment('Роль'),
            'first_name' => $this->string(100)->notNull()->comment('Имя'),
            'last_name' => $this->string(100)->notNull()->comment('Фамилия'),
            'patronymic' => $this->string(100)->null()->comment('Отчество'),
            'salary' => $this->float()->null()->comment('Оклад'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')->comment('Обновлено в'),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->comment('Создано в'),
            'deleted' => $this->boolean()->defaultValue(false)->comment('Удален')
        ]);

        $this->createTable('request_status', [
            'id' => $this->tinyInteger(3)->unsigned(),
            'name' => $this->string(100)->notNull()->comment('Статус заявки')
        ]);

        $this->addPrimaryKey(null, 'request_status', 'id');

        $this->batchInsert('request_status', ['id', 'name'], [
            [1, 'Новая'],
            [2, 'Обработанная'],
            [3, 'Пропущенная']
        ]);

        $this->createTable('request', [
            'id' => $this->bigPrimaryKey(),
            'manager_id' => $this->integer()->unsigned()->null()->comment('Менеджер'),
            'status_id' => $this->tinyInteger(3)->unsigned()->defaultValue(1)->comment('Статус'),
            'description' => $this->text()->comment('Описание'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')->comment('Обновлено в'),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->comment('Создано в'),
        ]);

        $this->addForeignKey('request-manager_id', 'request', 'manager_id', 'manager', 'id');
        $this->addForeignKey('request-status_id', 'request', 'status_id', 'request_status', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('request-manager_id', 'request');
        $this->dropForeignKey('request-status_id', 'request');
        $this->dropTable('manager');
        $this->dropTable('request_status');
        $this->dropTable('request');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180307_212830_init cannot be reverted.\n";

        return false;
    }
    */
}
