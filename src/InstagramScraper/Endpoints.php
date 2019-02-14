<?php

namespace InstagramScraper;

class Endpoints
{
    const BASE_URL = 'https://www.instagram.com';
    const LOGIN_URL = 'https://www.instagram.com/accounts/login/ajax/';
    const ACCOUNT_PAGE = 'https://www.instagram.com/{username}';
    const MEDIA_LINK = 'https://www.instagram.com/p/{code}';
    const ACCOUNT_MEDIAS = 'https://www.instagram.com/graphql/query/?query_hash=42323d64886122307be10013ad2dcc44&variables={variables}';
    const ACCOUNT_JSON_INFO = 'https://www.instagram.com/{username}/?__a=1';
    const MEDIA_JSON_INFO = 'https://www.instagram.com/p/{code}/?__a=1';
    const MEDIA_JSON_BY_LOCATION_ID = 'https://www.instagram.com/explore/locations/{{facebookLocationId}}/?__a=1&max_id={{maxId}}';
    const MEDIA_JSON_BY_TAG = 'https://www.instagram.com/explore/tags/{tag}/?__a=1&max_id={max_id}';
    const GENERAL_SEARCH = 'https://www.instagram.com/web/search/topsearch/?query={query}';
    const ACCOUNT_JSON_INFO_BY_ID = 'ig_user({userId}){id,username,external_url,full_name,profile_pic_url,biography,followed_by{count},follows{count},media{count},is_private,is_verified}';
    const COMMENTS_BEFORE_COMMENT_ID_BY_CODE = 'https://www.instagram.com/graphql/query/?query_hash=33ba35852cb50da46f5b5e889df7d159&variables={variables}';
    const LAST_LIKES_BY_CODE = 'ig_shortcode({{code}}){likes{nodes{id,user{id,profile_pic_url,username,follows{count},followed_by{count},biography,full_name,media{count},is_private,external_url,is_verified}},page_info}}';
    const LIKES_BY_SHORTCODE = 'https://www.instagram.com/graphql/query/?query_id=17864450716183058&variables={"shortcode":"{{shortcode}}","first":{{count}},"after":"{{likeId}}"}';
    const FOLLOWING_URL = 'https://www.instagram.com/graphql/query/?query_id=17874545323001329&id={{accountId}}&first={{count}}&after={{after}}';
    const FOLLOWERS_URL = 'https://www.instagram.com/graphql/query/?query_id=17851374694183129&id={{accountId}}&first={{count}}&after={{after}}';
    const FOLLOW_URL = 'https://www.instagram.com/web/friendships/{{accountId}}/follow/';
    const UNFOLLOW_URL = 'https://www.instagram.com/web/friendships/{{accountId}}/unfollow/';
    const USER_FEED = 'https://www.instagram.com/graphql/query/?query_id=17861995474116400&fetch_media_item_count=12&fetch_media_item_cursor=&fetch_comment_count=4&fetch_like=10';
    const USER_FEED2 = 'https://www.instagram.com/?__a=1';
    const INSTAGRAM_QUERY_URL = 'https://www.instagram.com/query/';
    const INSTAGRAM_CDN_URL = 'https://scontent.cdninstagram.com/';
    const ACCOUNT_JSON_PRIVATE_INFO_BY_ID = 'https://i.instagram.com/api/v1/users/{userId}/info/';
    const LIKE_URL = 'https://www.instagram.com/web/likes/{mediaId}/like/';
    const UNLIKE_URL = 'https://www.instagram.com/web/likes/{mediaId}/unlike/';
    const ADD_COMMENT_URL = 'https://www.instagram.com/web/comments/{mediaId}/add/';
    const DELETE_COMMENT_URL = 'https://www.instagram.com/web/comments/{mediaId}/delete/{commentId}/';

    const ACCOUNT_MEDIAS2 = 'https://www.instagram.com/graphql/query/?query_id=17880160963012870&id={{accountId}}&first=10&after=';

    // Look alike??
    const URL_SIMILAR = 'https://www.instagram.com/graphql/query/?query_id=17845312237175864&id=4663052';

    const GRAPH_QL_QUERY_URL = 'https://www.instagram.com/graphql/query/?query_id={{queryId}}';

    private static $requestMediaCount = 30;

    /**
     * @param int $count
     */
    public static function setAccountMediasRequestCount(int $count): void
    {
        static::$requestMediaCount = $count;
    }

    /**
     * @return int
     */
    public static function getAccountMediasRequestCount(): int
    {
        return static::$requestMediaCount;
    }

    /**
     * @param string $username
     * @return string
     */
    public static function getAccountPageLink(string $username): string
    {
        return str_replace('{username}', urlencode($username), static::ACCOUNT_PAGE);
    }

    /**
     * @param string $username
     * @return string
     */
    public static function getAccountJsonLink(string $username): string
    {
        return str_replace('{username}', urlencode($username), static::ACCOUNT_JSON_INFO);
    }

    /**
     * @param int $id
     * @return string
     */
    public static function getAccountJsonInfoLinkByAccountId(int $id): string
    {
        return str_replace('{userId}', urlencode($id), static::ACCOUNT_JSON_INFO_BY_ID);
    }

    /**
     * @param int $id
     * @return string
     */
    public static function getAccountJsonPrivateInfoLinkByAccountId(int $id): string
    {
        return str_replace('{userId}', urlencode($id), static::ACCOUNT_JSON_PRIVATE_INFO_BY_ID);
    }

    /**
     * @param string $variables
     * @return string
     */
    public static function getAccountMediasJsonLink(string $variables): string
    {
        return str_replace('{variables}', urlencode($variables), static::ACCOUNT_MEDIAS);
    }

    /**
     * @param string $code
     * @return string
     */
    public static function getMediaPageLink(string $code): string
    {
        return str_replace('{code}', urlencode($code), static::MEDIA_LINK);
    }

    /**
     * @param string $code
     * @return string
     */
    public static function getMediaJsonLink(string $code): string
    {
        return str_replace('{code}', urlencode($code), static::MEDIA_JSON_INFO);
    }

    /**
     * @param string $facebookLocationId
     * @param string $maxId
     * @return string
     */
    public static function getMediasJsonByLocationIdLink(string $facebookLocationId, string $maxId = ''): string
    {
        $url = str_replace('{{facebookLocationId}}', urlencode($facebookLocationId), static::MEDIA_JSON_BY_LOCATION_ID);
        return str_replace('{{maxId}}', urlencode($maxId), $url);
    }

    /**
     * @param string $tag
     * @param string $maxId
     * @return string
     */
    public static function getMediasJsonByTagLink(string $tag, string $maxId = ''): string
    {
        $url = str_replace('{tag}', urlencode($tag), static::MEDIA_JSON_BY_TAG);
        return str_replace('{max_id}', urlencode($maxId), $url);
    }

    /**
     * @param string $query
     * @return string
     */
    public static function getGeneralSearchJsonLink(string $query): string
    {
        return str_replace('{query}', urlencode($query), static::GENERAL_SEARCH);
    }

    /**
     * @param string $variables
     * @return string
     */
    public static function getCommentsBeforeCommentIdByCode(string $variables): string
    {
        return str_replace('{variables}', urlencode($variables), static::COMMENTS_BEFORE_COMMENT_ID_BY_CODE);
    }

    /**
     * @param string $code
     * @return string
     */
    public static function getLastLikesByCodeLink(string $code): string
    {
        return str_replace('{{code}}', urlencode($code), static::LAST_LIKES_BY_CODE);
    }

    /**
     * @param string $code
     * @param int $count
     * @param string $lastLikeID
     * @return string
     */
    public static function getLastLikesByCode(string $code, int $count, string $lastLikeID): string
    {
        $url = str_replace('{{shortcode}}', urlencode($code), static::LIKES_BY_SHORTCODE);
        $url = str_replace('{{count}}', urlencode($count), $url);
        $url = str_replace('{{likeId}}', urlencode($lastLikeID), $url);

        return $url;
    }

    /**
     * @param int $accountId
     * @return string
     */
    public static function getFollowUrl(int $accountId): string
    {
        return str_replace('{{accountId}}', urlencode($accountId), static::FOLLOW_URL);
    }

    /**
     * @param int $accountId
     * @param int $count
     * @param string $after
     * @return string
     */
    public static function getFollowersJsonLink(int $accountId, int $count, string $after = ''): string
    {
        $url = str_replace('{{accountId}}', urlencode($accountId), static::FOLLOWERS_URL);
        $url = str_replace('{{count}}', urlencode($count), $url);

        if ($after === '') {
            return str_replace('&after={{after}}', '', $url);
        }

        return str_replace('{{after}}', urlencode($after), $url);
    }

    /**
     * @param int $accountId
     * @param int $count
     * @param string $after
     * @return string
     */
    public static function getFollowingJsonLink(int $accountId, int $count, string $after = ''): string
    {
        $url = str_replace('{{accountId}}', urlencode($accountId), static::FOLLOWING_URL);
        $url = str_replace('{{count}}', urlencode($count), $url);

        if ($after === '') {
            return str_replace('&after={{after}}', '', $url);
        }

        return str_replace('{{after}}', urlencode($after), $url);
    }

    /**
     * @return string
     */
    public static function getUserStoriesLink()
    {
        return self::getGraphQlUrl(InstagramQueryId::USER_STORIES, ['variables' => json_encode([])]);
    }

    /**
     * @param int $queryId
     * @param array $parameters
     * @return string
     */
    public static function getGraphQlUrl(int $queryId, array $parameters): string
    {
        $url = str_replace('{{queryId}}', urlencode($queryId), static::GRAPH_QL_QUERY_URL);
        if (!empty($parameters)) {
            $query_string = http_build_query($parameters);
            $url .= '&' . $query_string;
        }
        return $url;
    }

    /**
     * @param array $variables
     * @return string
     */
    public static function getStoriesLink(array $variables): string
    {
        return self::getGraphQlUrl(InstagramQueryId::STORIES, ['variables' => json_encode($variables)]);
    }

    /**
     * @param int $mediaId
     * @return string
     */
    public static function getLikeUrl(int $mediaId): string
    {
        return str_replace('{mediaId}', urlencode($mediaId), static::LIKE_URL);
    }

    /**
     * @param int $mediaId
     * @return string
     */
    public static function getUnlikeUrl(int $mediaId): string
    {
        return str_replace('{mediaId}', urlencode($mediaId), static::UNLIKE_URL);
    }

    /**
     * @param int $mediaId
     * @return string
     */
    public static function getAddCommentUrl(int $mediaId): string
    {
        return str_replace('{mediaId}', $mediaId, static::ADD_COMMENT_URL);
    }

    /**
     * @param int $mediaId
     * @param int $commentId
     * @return string
     */
    public static function getDeleteCommentUrl(int $mediaId, int $commentId): string
    {
        $url = str_replace('{mediaId}', $mediaId, static::DELETE_COMMENT_URL);
        $url = str_replace('{commentId}', $commentId, $url);
        return $url;
    }
}
