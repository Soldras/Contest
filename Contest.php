<?php
/**
 * This class has been generated by TheliaStudio
 * For more information, see https://github.com/thelia-modules/TheliaStudio
 */

namespace Contest;

use Contest\Model\AnswerQuery;
use Contest\Model\Base\GameQuery;
use Contest\Model\ParticipateQuery;
use Contest\Model\QuestionQuery;
use Thelia\Module\BaseModule;
use Propel\Runtime\Connection\ConnectionInterface;
use Thelia\Install\Database;

/**
 * Class Contest
 * @package Contest
 */
class Contest extends BaseModule
{
    const MESSAGE_DOMAIN = "contest";
    const ROUTER = "router.contest";

    public function postActivation(ConnectionInterface $con = null)
    {

        try {
            GameQuery::create()->findOne();
            QuestionQuery::create()->findOne();
            AnswerQuery::create()->findOne();
            ParticipateQuery::create()->findOne();
        } catch (\Exception $e) {
            $database = new Database($con);
            $database->insertSql(null, [__DIR__ . "/Config/create.sql", __DIR__ . "/Config/insert.sql"]);
        }
    }
}