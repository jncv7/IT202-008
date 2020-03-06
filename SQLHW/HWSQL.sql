/*
    The table will be to make items a
    there will be columns to represent their -->

        1. value / price
        2. rarity type
        3. series or what update the item came into the table
        4. and an ID so that we can track where it is going (maybe)
        5. will probably also put a collum for when the item or its "series was made"
        6. date and time the item was actually made
        7. where / or what inventory the item is currently inside of

*/


Create Table itemIndex (
    -- note the you need to adhear to the things uptop --
    id INT,
    rarity CHAR (3), --- the rarities are from C, N, R, RR, RRR, SR, S, SS, SSS, G --
    price int,
    series varchar (15),
    createdTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    currentInventory varChar (500)

);