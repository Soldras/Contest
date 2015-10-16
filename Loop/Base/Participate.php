<?php
/**
* This class has been generated by TheliaStudio
* For more information, see https://github.com/thelia-modules/TheliaStudio
*/

namespace Contest\Loop\Base;

use Propel\Runtime\ActiveQuery\Criteria;
use Thelia\Core\Template\Element\BaseLoop;
use Thelia\Core\Template\Element\LoopResult;
use Thelia\Core\Template\Element\LoopResultRow;
use Thelia\Core\Template\Element\PropelSearchLoopInterface;
use Thelia\Core\Template\Loop\Argument\Argument;
use Thelia\Core\Template\Loop\Argument\ArgumentCollection;
use Thelia\Type\BooleanOrBothType;
use Contest\Model\ParticipateQuery;

/**
 * Class Participate
 * @package Contest\Loop\Base
 * @author TheliaStudio
 */
class Participate extends BaseLoop implements PropelSearchLoopInterface
{

    /**
     * @param LoopResult $loopResult
     *
     * @return LoopResult
     */
    public function parseResults(LoopResult $loopResult)
    {
        /** @var \Contest\Model\Participate $entry */
        foreach ($loopResult->getResultDataCollection() as $entry) {
            $row = new LoopResultRow($entry);

            $row
                ->set("ID", $entry->getId())
                ->set("EMAIL", $entry->getEmail())
                ->set("WIN", $entry->getWin())
                ->set("GAME_ID", $entry->getGameId())
                ->set("CUSTOMER_ID", $entry->getCustomerId())
            ;

            $this->addMoreResults($row, $entry);

            $loopResult->addRow($row);
        }

        return $loopResult;
    }

    /**
     * Definition of loop arguments
     *
     * example :
     *
     * public function getArgDefinitions()
     * {
     *  return new ArgumentCollection(
     *
     *       Argument::createIntListTypeArgument('id'),
     *           new Argument(
     *           'ref',
     *           new TypeCollection(
     *               new Type\AlphaNumStringListType()
     *           )
     *       ),
     *       Argument::createIntListTypeArgument('category'),
     *       Argument::createBooleanTypeArgument('new'),
     *       ...
     *   );
     * }
     *
     * @return \Thelia\Core\Template\Loop\Argument\ArgumentCollection
     */
    protected function getArgDefinitions()
    {
        return new ArgumentCollection(
            Argument::createIntListTypeArgument("id"),
            Argument::createAnyTypeArgument("email"),
            Argument::createBooleanOrBothTypeArgument("win", BooleanOrBothType::ANY),
            Argument::createIntListTypeArgument("game_id"),
            Argument::createIntListTypeArgument("customer_id"),
            Argument::createEnumListTypeArgument(
                "order",
                [
                    "id",
                    "id-reverse",
                    "email",
                    "email-reverse",
                    "win",
                    "win-reverse",
                    "game_id",
                    "game_id-reverse",
                    "customer_id",
                    "customer_id-reverse",
                ],
                "id"
            )
        );
    }

    /**
     * this method returns a Propel ModelCriteria
     *
     * @return \Propel\Runtime\ActiveQuery\ModelCriteria
     */
    public function buildModelCriteria()
    {
        $query = new ParticipateQuery();

        if (null !== $id = $this->getId()) {
            $query->filterById($id);
        }

        if (null !== $email = $this->getEmail()) {
            $email = array_map("trim", explode(",", $email));
            $query->filterByEmail($email);
        }

        if (BooleanOrBothType::ANY !== $win = $this->getWin()) {
            $query->filterByWin($win);
        }

        if (null !== $game_id = $this->getGameId()) {
            $query->filterByGameId($game_id);
        }

        if (null !== $customer_id = $this->getCustomerId()) {
            $query->filterByCustomerId($customer_id);
        }

        foreach ($this->getOrder() as $order) {
            switch ($order) {
                case "id":
                    $query->orderById();
                    break;
                case "id-reverse":
                    $query->orderById(Criteria::DESC);
                    break;
                case "email":
                    $query->orderByEmail();
                    break;
                case "email-reverse":
                    $query->orderByEmail(Criteria::DESC);
                    break;
                case "win":
                    $query->orderByWin();
                    break;
                case "win-reverse":
                    $query->orderByWin(Criteria::DESC);
                    break;
                case "game_id":
                    $query->orderByGameId();
                    break;
                case "game_id-reverse":
                    $query->orderByGameId(Criteria::DESC);
                    break;
                case "customer_id":
                    $query->orderByCustomerId();
                    break;
                case "customer_id-reverse":
                    $query->orderByCustomerId(Criteria::DESC);
                    break;
            }
        }

        return $query;
    }

    protected function addMoreResults(LoopResultRow $row, $entryObject)
    {
    }
}