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
 * Class BinaryTreeException
 */
class BinaryTreeException extends Exception {};

/**
 * Class BinaryTree
 */
class BinaryTree {
    protected $_root;

    /**
     * BinaryTree constructor.
     * @param null $items
     * @throws BinaryTreeException
     */
    public function __construct($items = null) {
        $this->_root = new Leaf();

        if (is_array($items)) {
            $this->addItems($items);
        }
    }

    public function addItem($item) {
        $this->_root = $this->_root->insert($item);
        return $this;
    }

    /**
     * @param $items
     * @return $this
     * @throws BinaryTreeException
     */
    public function addItems($items) {
        if (!is_array($items)) {
            throw new BinaryTreeException('Argument type mismatch.  Array expected.');
        }

        foreach ($items as $item) {
            $this->addItem($item);
        }

        return $this;
    }
}