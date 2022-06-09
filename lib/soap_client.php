class SoapClient {
/* Métodos */
public __call(string $function_name, array $arguments): mixed
public __construct(mixed $wsdl, array $options = ?)
public __doRequest(
    string $request,
    string $location,
    string $action,
    int $version,
    int $one_way = 0
): string
public __getCookies(): array
public __getFunctions(): array
public __getLastRequest(): string
public __getLastRequestHeaders(): string
public __getLastResponse(): string
public __getLastResponseHeaders(): string
public __getTypes(): array
public __setCookie(string $name, string $value = ?): void
public __setLocation(string $new_location = ?): string
public __setSoapHeaders(mixed $soapheaders = ?): bool
public __soapCall(
    string $function_name,
    array $arguments,
    array $options = ?,
    mixed $input_headers = ?,
    array &$output_headers = ?
): mixed
}