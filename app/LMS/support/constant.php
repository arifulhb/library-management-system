<?php

    const USER_STATUS_ACTIVE = 1;
    const USER_STATUS_INACTIVE = 0;
    const USER_TYPE_ADMIN = 'Admin';
    const USER_TYPE_MEMBER = 'Member';


    /**
     * Membership Age
     */
    const JUNIOR_MEMBER_AGE_LIMIT = 12;

    /**
     * BOOK BORROW LIMIT
     */
    const FULL_MEMBER_BORROW_LIMIT = 6;
    const JUNIOR_MEMBER_BORROW_LIMIT = 3;

    /**
     * BOOK RESERVATION /  BORROW STATUS
     */
    const BOOK_RETURN_FALSE = 0;
    const BOOK_RETURN_TRUE = 1;

    /**
     * BookCopy status
     */
    const BOOK_COPY_STATUS_ON_LOAN = 0;
    const BOOK_COPY_STATUS_ACTIVE = 1;
    const BOOK_COPY_STATUS_LOST = 2;
    const BOOK_COPY_STATUS_DAMAGED = 3;
    const BOOK_COPY_STATUS_WITHDRAWN = 4;
