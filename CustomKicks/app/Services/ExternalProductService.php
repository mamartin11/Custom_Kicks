<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ExternalProductService
{
    protected string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('app.external_product_api_url');
        if (! $this->baseUrl) {
            // Fallback if the .env variable is not found in the cached config,
            // though ideally, it should be picked up after `config:cache` or `config:clear`.
            $this->baseUrl = env('EXTERNAL_PRODUCT_API_URL');
        }
    }

    /**
     * Fetches products from the external API.
     *
     * @return array|null An array of products or null if an error occurred.
     */
    public function getProducts(): ?array
    {
        if (! $this->baseUrl) {
            Log::error('External Product API URL is not configured.');

            return null;
        }

        $url = $this->baseUrl.'/api/products';

        try {
            $response = Http::timeout(15)->get($url);

            if ($response->successful()) {
                $products = $response->json();

                // The API returns a JSON array directly.
                // Based on the screenshot, it seems the API returns an array of products directly.
                return $products;
            }

            Log::error('Failed to fetch products from external API.', [
                'status' => $response->status(),
                'response' => $response->body(),
                'url' => $url,
            ]);

            return null;

        } catch (ConnectionException $e) { // More specific import for ConnectionException
            Log::error('Connection error while fetching products from external API.', [
                'message' => $e->getMessage(),
                'url' => $url,
            ]);

            return null;
        } catch (\Exception $e) {
            Log::error('An unexpected error occurred while fetching products.', [
                'message' => $e->getMessage(),
                'url' => $url,
            ]);

            return null;
        }
    }

    /**
     * Constructs the full image URL for a product.
     *
     * @param  string  $imagePath  The relative path of the image from the API.
     * @return string The full image URL.
     */
    public function getFullImageUrl(string $imagePath): string
    {
        // The API response shows imagePath like: "/storage/img/products/..."
        // We need to combine it with the base URL of the *external* API.
        return rtrim($this->baseUrl, '/').'/'.ltrim($imagePath, '/');
    }
}
