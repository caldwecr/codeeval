<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 2/19/14
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
    /**
     * Despite the presence of these loops the algorithm remains O(1) as the loops do not grow in size relative to the rectangles
     * In otherwords these loops could be rewritten as static code that checks each of the points
     */
    foreach($points2 as $key => $point) {
        if(Rectangle::containsPoint($r1, $point)) {
            $pointsInside1[$key] = $point;
        }
    }
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
        case 0: // There are zero vertices from rectangle 2 in rectangle 1
            if($count1in2 === 0) { // The two rectangles do not intersect
                return $baseArea;
            } else if ($count1in2 === 2) { // Rectangle 1 has two vertices in rectangle 2
                $intersectR = Rectangle::getIntersectingRectangleForTwoPoints($pointsInside2, $r2);
                return $baseArea - $intersectR->getArea();
            } else if ($count1in2 === 4) { // Rectangle 1 is entirely inside rectangle 2
                return $r2->getArea();
            }
            break; // This isn't necessary but is included for readability
        case 1: // There is one vertex from rectangle 2 in rectangle 1, which means there is also one vertex from rectangle 1 in rectangle 2
            $intersectR = new Rectangle(current($pointsInside1), current($pointsInside2));
            return $baseArea - $intersectR->getArea();
            break; // This isn't necessary but is included for readability
        case 2: // There are two vertices from rectangle 2 in rectangle 1
            $intersectR = Rectangle::getIntersectingRectangleForTwoPoints($pointsInside1, $r1);
            return $baseArea - $intersectR->getArea();
            break; // This isn't necessary but is included for readability
        case 4: // Rectangle 2 is entirely contained by rectangle 1
            return $r1->getArea();
            break; // This isn't necessary but is included for readability
    }
}

/**
 * Class Point
 *
 * A point in two-dimensional space represented by an x and y coordinate
 */
class Point
{
    /**
     * @var float
     */
    public $x;

    /**
     * @var float
     */
    public $y;

    /**
     * @param float $x
     * @param float $y
     */
    public function __construct($x, $y) {
        $this->x = $x;
        $this->y = $y;
    }
}

/**
 * Class Rectangle
 *
 * A rectangle in two dimensional space represented by x and y axes
 *
 * The vertices are listed in clockwise order starting with the upper left vertex
 */
class Rectangle
{
    /**
     * @var Point
     */
    protected $ul;

    /**
     * @var Point
     */
    protected $ur;

    /**
     * @var Point
     */
    protected $lr;

    /**
     * @var Point
     */
    protected $ll;

    /**
     * @param Point $ll
     * @param Point $ur
     */
    public function __construct(Point $ll, Point $ur)
    {
        $this->ll = $ll;
        $this->ur = $ur;
        $this->ul = new Point($ll->x, $ur->y);
        $this->lr = new Point($ur->x, $ll->y);
    }

    /**
     * @return array
     */
    public function getPoints()
    {
        return array(
            'ul' => $this->ul,
            'ur' => $this->ur,
            'lr' => $this->lr,
            'll' => $this->ll
        );
    }

    /**
     * @return number
     */
    public function getArea()
    {
        return $this->getLength() * $this->getHeight();
    }

    /**
     * @return number
     */
    public function getLength()
    {
        return abs($this->ur->x - $this->ul->x);
    }

    /**
     * @return number
     */
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

    /**
     * @return float
     */
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

    /**
     * @return float
     */
    public function getMinY()
    {
        return $this->lr->y;
    }

    /**
     * @param Rectangle $r
     * @param Point $p
     * @return bool
     */
    public static function containsPoint(Rectangle $r, Point $p)
    {
       return   $p->x > $r->getMinX() &&
                $p->x < $r->getMaxX() &&
                $p->y > $r->getMinY() &&
                $p->y < $r->getMaxY();
    }

    /**
     * @param array $pointsInside
     * @param Rectangle $containingRectangle
     * @return null|Rectangle
     */
    public static function getIntersectingRectangleForTwoPoints($pointsInside, $containingRectangle)
    {
        $code = 0; // Using powers of two to identify which two corners (based on array keys) are inside the containing rectangle
        foreach($pointsInside as $key => $point) {
            switch($key) {
                case 'ul':
                    $code += 2;
                    break;
                case 'ur':
                    $code += 4;
                    break;
                case 'lr':
                    $code += 8;
                    break;
                case 'll':
                    $code += 16;
                    break;
            }
        }
        $intersectR = null;

        switch($code) {
            case 6: // ul and ur of 1 are in 2
                $intersectR = new Rectangle(new Point($pointsInside['ul']->x, $containingRectangle->getMinY()), $pointsInside['ur']);
                break;
            case 12: // ur and lr of 1 are in 2
                $intersectR = new Rectangle(new Point($containingRectangle->getMinX(), $pointsInside['lr']->y), $pointsInside['ur']);
                break;
            case 24: // lr and ll of 1 are in 2
                $intersectR = new Rectangle($pointsInside['ll'], new Point($pointsInside['lr']->x, $containingRectangle->getMaxY()));
                break;
            case 18: // ll and ul of 1 are in 2
                $intersectR = new Rectangle($pointsInside['ll'], new Point($containingRectangle->getMaxX(), $pointsInside['ul']->y));
                break;
        }
        return $intersectR;
    }
}