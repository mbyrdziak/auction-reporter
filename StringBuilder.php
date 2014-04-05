<?php
class StringBuilder {

    private $string;

    /**
     * @param string $string
     */
    public function append($string) {
        $this->string .= $string;
    }

    public function __toString() {
        return $this->string;
    }
} 