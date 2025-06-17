<?php

declare(strict_types=1);

namespace App\Enum;

enum Status: string
{
	case ODRZUCONY = 'odrzucony';
    case OCZEKUJACY = 'oczekujący';
    case WYKONANY = 'wykonany';
	

    private static function fromString(string $value): int
    {
        $cases = array_values(array_column(self::cases(), 'value'));
    	if (!in_array($value, array_values($cases))) {
    		throw new \InvalidArgumentException("Invalid status value: $value");
    	}
    	
    	return array_search($value, $cases);
    }

    private static function fromInt(int $value): string
    {
    	$cases = array_values(array_column(self::cases(), 'value'));
    	
    	if (!in_array($value, array_keys($cases))) {
    		throw new \InvalidArgumentException("Invalid status value: $value");
    	}
    	
    	return $cases[$value];
    }
    
    public static function get(int|string $value)
    {
    	if (is_int($value)) {
    		return self::fromInt($value);
    	} else if (is_string($value)) {
    		return self::fromString($value);
    	} else {
    		throw new \InvalidArgumentException("Invalid argument type");
    	}
    }
}
