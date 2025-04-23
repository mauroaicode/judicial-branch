<?php

namespace Core\BoundedContext\Tenant\Filing\Application\Responses;

use Core\BoundedContext\Tenant\Filing\Domain\Filings;

final class FilingsResponse
{

    public function __construct(private array $filings){}

    public static function fromFilings(Filings $filings): FilingsResponse
    {
        $customerResponses = array_map(
            function ($customer) {
                return FilingResponse::fromFiling($customer);
            },
            $filings->all()
        );
        return new self($customerResponses);
    }

    public function toArray(): array
    {
        return array_map(function (FilingResponse $filingResponse) {
            return $filingResponse->toArray();
        }, $this->filings);
    }
}
