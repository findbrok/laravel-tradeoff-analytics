<?php

namespace FindBrok\TradeoffAnalytics\Contracts;

use stdClass;
use InvalidArgumentException;

interface DataModelInterface
{
    /**
     * Sets data to the model.
     *
     * @param mixed $data
     *
     * @throws InvalidArgumentException
     *
     * @return $this
     */
    public function setData($data);

    /**
     * Maps a stdObject to Model.
     *
     * @param stdClass $data
     *
     * @return $this
     */
    public function mapObjectDataToModel(stdClass $data);

    /**
     * Maps an array to Model.
     *
     * @param array $data
     *
     * @throws InvalidArgumentException
     *
     * @return $this
     */
    public function mapArrayDataToModel(array $data = []);

    /**
     * Maps a Json string to Model.
     *
     * @param $jsonString
     *
     * @throws InvalidArgumentException
     *
     * @return $this
     */
    public function mapJsonDataToModel($jsonString);
}
