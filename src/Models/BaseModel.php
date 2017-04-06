<?php

namespace FindBrok\TradeoffAnalytics\Models;

use stdClass;
use JsonMapper;
use InvalidArgumentException;
use FindBrok\TradeoffAnalytics\Contracts\DataModelInterface;

abstract class BaseModel implements DataModelInterface
{
    /**
     * Gets the JsonMapper instance.
     *
     * @return JsonMapper
     */
    public function getMapper()
    {
        return app(JsonMapper::class);
    }

    /**
     * Sets data to the model.
     *
     * @param mixed $data
     *
     * @throws InvalidArgumentException
     *
     * @return $this
     */
    public function setData($data)
    {
        // Data is an array.
        if (is_array($data)) {
            return $this->mapArrayDataToModel($data);
        }

        // Data is an object.
        if (is_object($data) && $data instanceof stdClass) {
            return $this->mapObjectDataToModel($data);
        }

        // Data is a JSON string
        if (is_string($data)) {
            $objectData = json_decode($data);

            // Invalid Json
            if (json_last_error() !== JSON_ERROR_NONE) {
                $this->sendInvalidDataError('Json string supplied to model "'.get_class($this).'" is not valid.');
            }

            return $this->mapObjectDataToModel($objectData);
        }

        $this->sendInvalidDataError('Data supplied to model "'.get_class($this).'" does not match a valid type');
    }

    /**
     * Maps a stdObject to Model.
     *
     * @param stdClass $data
     *
     * @return $this
     */
    public function mapObjectDataToModel(stdClass $data)
    {
        $this->getMapper()->map($data, $this);

        return $this;
    }

    /**
     * Maps an array to Model.
     *
     * @param array $data
     *
     * @throws InvalidArgumentException
     *
     * @return $this
     */
    public function mapArrayDataToModel(array $data = [])
    {
        // Convert array to Object.
        $objectData = json_decode(json_encode($data));

        // Json is not valid.
        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->sendInvalidDataError('Array string supplied to model "'.get_class($this).'" is not valid.');
        }

        return $this->mapObjectDataToModel($objectData);
    }

    /**
     * Maps a Json string to Model.
     *
     * @param $jsonString
     *
     * @throws InvalidArgumentException
     *
     * @return $this
     */
    public function mapJsonDataToModel($jsonString)
    {
        // Decode Json string as stdObject.
        $objectData = json_decode($jsonString);

        // Json is not valid.
        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->sendInvalidDataError('Json string supplied to model "'.get_class($this).'" is not valid.');
        }

        return $this->mapObjectDataToModel($objectData);
    }

    /**
     * Throws an exception to inform if invalid input.
     *
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    protected function sendInvalidDataError($message = '')
    {
        throw new InvalidArgumentException($message);
    }
}
