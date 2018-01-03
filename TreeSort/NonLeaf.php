<?php
/**
 * Copyright (c) 2018. Michael Dietz
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Class NonLeafException
 */
class NonLeafException extends Exception {}

/**
 * Class NonLeaf
 */
class NonLeaf implements TreeNode {
    const ALLOW_DUPLICATES = false;
    const DEFAULT_DUPLICATES_TO_LEFT = false;

    protected $_item;
    protected $_left;
    protected $_right;

    public function __construct($item) {
        $this->_item = $item;
        $this->_left = new Leaf();
        $this->_right = new Leaf();
    }

    /**
     * @param $item
     * @return $this
     * @throws NonLeafException
     */
    public function insert($item) {
        if ($item == $this->_item && !self::ALLOW_DUPLICATES) {
            throw new NonLeafException('Duplicate values are not allowed.');
        }

        if ($item < $this->_item || ($item == $this->_item && self::DEFAULT_DUPLICATES_TO_LEFT)) {
            $this->_left = $this->_left->insert($item);
            return $this;
        }

        $this->_right = $this->_right->insert($item);
        return $this;
    }
}