<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 2/19/14
 * Time: 5:23 PM
 */

/**
 * @param float $A - x value of the lower left corner of rectangle 1
 * @param float $B - y value of the lower left corner of rectangle 1
 * @param float $C - x value of the upper right corner of rectangle 1
 * @param float $D - y value of the upper right corner of rectangle 1
 * @param float $K - x value of the lower left corner of rectangle 2
 * @param float $L - y value of the lower left corner of rectangle 2
 * @param float $M - x value of the upper right corner of rectangle 2
 * @param float $N - y value of the upper right corner of rectangle 2
 *
 * @return float
 *
 * This method finds the combined area of two rectangles having edges parallel to the x-axis and the y-axis
 * of a cartesian plot. When the rectangles have an overlapping section the overlapping area should only be counted one time
 *
 * The problem (as I remember it) required a constant time and space solution
 *
 * Description of the solution
 *  - There are four possible scenarios in this approach
 * 1. The rectangles do not intersect
 * 2. One vertex of each rectangle is contained inside the other rectangle
 * 3. Two verticies of one rectange are contained in the other rectangle
 * 4. One rectangle is entirely contained by the other rectangle
 *
 * We can figure out which scenario by counting the number of vertices (points) contained in each rectangle
 *
 */
function solution($A, $B, $C, $D, $K, $L, $M, $N)
{
    $ll1 = new Point($A, $B);
    $ur1 = new Point($C, $D);
    $ll2 = new Point($K, $L);
    $ur2 = new Point($M, $N);
    // Figure out how many vertices of the second rectangle are inside the first rectangle
    $r1 = new Rectangle($ll1, $ur1);
    $r2 = new Rectangle($ll2, $ur2);


    $pointsInside1 = array();
    $pointsInside2 = array();

    $points2 = $r2->getPoints();
    foreach($points2 as $key => $point) {
        if(Rectangle::containsPoint($r1, $point)) {
            $pointsInside1[$key] = $point;
        }
    }
    // This is really only necessary if count2in1 is 0, but I decided to leave it to always execute for simplification
    $points1 = $r1->getPoints();
    foreach($points1 as $key => $point) {
        if(Rectangle::containsPoint($r2, $point)) {
            $pointsInside2[$key] = $point;
        }
    }

    $count2in1 = count($pointsInside1);
    $count1in2 = count($pointsInside2);
    $baseArea = $r1->getArea() + $r2->getArea();
    switch($count2in1) {
        case 0:
            if($count1in2 === 0) {
                return $baseArea;
            } else if ($count1in2 === 2) {
                // The two points are going to either have matching x values or matching y values
            }
            break;
        case 1:
            $intersectR = new Rectangle(current($pointsInside1), current($pointsInside2));
            return $baseArea - $intersectR->getArea();
            break;
    }


}

class Point
{
    public $x;
    public $y;

    public function __construct($x, $y) {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * @param Point $p1
     * @param Point $p2
     * @return number
     */
    public static function distanceBetweenTwoPoints(Point $p1, Point $p2) {
        return sqrt(pow(abs($p1->x - $p2->x), 2) + pow(abs($p1->y - $p2->y), 2));
    }
}

class Rectangle
{
    protected $ul;

    protected $ur;

    protected $lr;

    protected $ll;

    public function __construct(Point $ll, Point $ur)
    {
        $this->ll = $ll;
        $this->ur = $ur;
        $this->ul = new Point($ll->x, $ur->y);
        $this->lr = new Point($ur->x, $ll->y);
    }

    public function getPoints()
    {
        return array(
            'ul' => $this->ul,
            'ur' => $this->ur,
            'lr' => $this->lr,
            'll' => $this->ll
        );
    }

    public function getArea()
    {
        return $this->getLength() * $this->getHeight();
    }

    public function getLength()
    {
        return abs($this->ur->x - $this->ul->x);
    }

    public function getHeight()
    {
        return abs($this->ur->y - $this->lr->y);
    }

    /**
     * @return float
     *
     * This method returns the maximum x value that is inside the rectangle
     */
    public function getMaxX()
    {
        return $this->ur->x;
    }

    public function getMinX()
    {
        return $this->ul->x;
    }

    /**
     * @return float
     *
     * This method returns the maximum y value that is inside the rectangle
     */
    public function getMaxY()
    {
        return $this->ur->y;
    }

    public function getMinY()
    {
        return $this->lr->y;
    }

    public static function containsPoint(Rectangle $r, Point $p)
    {
       return   $p->x > $r->getMinX() &&
                $p->x < $r->getMaxX() &&
                $p->y > $r->getMinY() &&
                $p->y < $r->getMaxY();
    }
}