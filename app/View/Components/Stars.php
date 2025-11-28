<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Stars extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?float $value = null,
        public int $max = 5,
        public mixed $for = null,
        public mixed $reviews = null,
        public bool $withCount = false,
        public int $round = 0,
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        [$displayValue, $count] = $this->compute();

        return view('components.stars', [
            'displayValue' => $displayValue,
            'count' => $count,
        ]);
    }

    /**
     * Compute average rating and count.
     * - If an explicit numeric value is provided, use it.
     * - Else, compute from provided `reviews` or from `$for->reviews` if present.
     * Works with arrays, iterables, or Eloquent collections without requiring specific model methods.
     *
     * @return array{0:int,1:int}
     */
    protected function compute(): array
    {
        // Explicit value wins
        if ($this->value !== null) {
            $val = (float) $this->value;
            $rounded = $this->round > 0 ? round($val, $this->round) : round($val);
            return [max(0, min((int) $rounded, $this->max)), 0];
        }

        // Source reviews from prop or `$for->reviews` if available
        $reviews = $this->reviews;
        if ($reviews === null && $this->for && isset($this->for->reviews)) {
            // Avoid triggering extra queries; just read the property if present
            try {
                $reviews = $this->for->reviews;
            } catch (\Throwable) {
                $reviews = null;
            }
        }

        $sum = 0.0;
        $count = 0;
        $avg = 0.0;
        if (is_iterable($reviews)) {
            foreach ($reviews as $r) {
                $stars = null;
                if (is_array($r)) {
                    $stars = $r['stars'] ?? null;
                } elseif (is_object($r)) {
                    $stars = $r->stars ?? null;
                }
                if (is_numeric($stars)) {
                    $sum += (float) $stars;
                    $count++;
                }
            }
            if ($count > 0) {
                $avg = $sum / $count;
            }
        }

        $rounded = $this->round > 0 ? round($avg, $this->round) : round($avg);
        $display = max(0, min((int) $rounded, $this->max));

        return [$display, $count];
    }
}
