<?php

namespace FindBrok\TradeoffAnalytics\Models;

use stdClass;
use JsonMapper;
use JsonSerializable;
use InvalidArgumentException;
use Illuminate\Support\Traits\Macroable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Arrayable;
use FindBrok\TradeoffAnalytics\Contracts\DataModelInterface;

abstract class AbstractModel implements DataModelInterface, Arrayable, Jsonable, JsonSerializable
{
    use Macroable;

    /**
     * Get a property.
     *
     * @param string $name
     *
     * @return mixed
     */
    public function __get($name)
    {
        // Return Property if its there.
        if (property_exists($this, $name)) {
            return $this->{$name};
        }

        // Nothing to return.
        return null;
    }

    /**
     * Gets the JsonMapper instance.
     *
     * @return JsonMapper
     */
    public function getMapper()
    {
        $jm = app(JsonMapper::class);
        $jm->bIgnoreVisibility = true;

        return $jm;
    }

    /**
     * Sets data to the model.
     *
     * @param array|string|stdClass $data
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
        $objectData = json_decode(json_encode($data), false);

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
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        // Get the Array Representation of the object.
        $arrayRep = array_map(function ($value) {
            return $value instanceof Arrayable ? $value->toArray() : $value;
        }, get_object_vars($this));

        // Remove null values and return.
        return collect($arrayRep)->reject(function ($item) {
            return is_null($item);
        })->toArray();
    }

    /**
     * Convert the object to its JSON representation.
     *
     * @param  int $options
     *
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->jsonSerialize(), $options);
    }

    /**
     * Convert the object into something JSON serializable.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        // Get the Array Representation of the object.
        $arrayRep = array_map(function ($value) {
            if ($value instanceof JsonSerializable) {
                return $value->jsonSerialize();
            } elseif ($value instanceof Jsonable) {
                return json_decode($value->toJson(), true);
            } elseif ($value instanceof Arrayable) {
                return $value->toArray();
            } else {
                return $value;
            }
        }, get_object_vars($this));

        // Remove null values and return.
        return collect($arrayRep)->reject(function ($item) {
            return is_null($item);
        })->jsonSerialize();
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
