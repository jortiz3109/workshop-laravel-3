/**
 * The base font awesome builder api
 */
import fontawesome from '@fortawesome/fontawesome';

/**
 * Available icon stacks
 *
 * fontawesome-free-solid
 * fontawesome-free-regular
 * fontawesome-free-brands
 */

/**
 * Import and add
 */
import solid from '@fortawesome/fontawesome-free-solid';
import brands from '@fortawesome/fontawesome-free-brands';
fontawesome.library.add(solid);
fontawesome.library.add(brands);
