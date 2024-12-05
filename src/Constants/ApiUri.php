<?php
namespace Lecangs\OpenApi\Constants;

class ApiUri
{
    // 获取品类
    const CATEGORY_LIST = '/oms/category/api/list';

    // 获取仓库列表，客户的可用仓库
    const GET_WAREHOUSE = '/oms/omsCustom/api/getWarehouse';

    // 获取承运商
    const GET_CARRIER = '/tms/carrier/api/select';

    // 获取快递产品
    const SALE_PRODUCT = '/tms/saleProduct/api/list';

    // 获取余额与信用额度
    const GET_BALANCE = '/oms/omsCustom/api/getBalance';

    // 查询货品列表
    const GOODS_LIST = '/oms/goods/api/list';

    // 创建货品
    const ADD_GOOD = '/oms/goodsTemp/api/add';

    // 编辑货品
    const EDIT_GOOD = '/oms/goodsTemp/api/edit';

    // 分页查询库存
    const INVENTORY_OVERVIEW = '/oms/inventoryOverview/apiPage';

    // 库存流水
    const INVENTORY_FLOW = '/oms/inventoryFlow/api/listByPage';

    // 批次库存
    const INVENTORY_BATCH = '/oms/inventoryBatch/api/list';

    // 创建发货通知单
    const ADD_ASN = '/oms/asnTemp/api/add';

    // 编辑发货通知单
    const EDIT_ASN = '/oms/asnTemp/api/edit';

    // 查询发货通知单详情
    const GET_ASN = '/oms/asnTemp/api/getByAsnCode';

    // 批量查询入库单
    const GET_ASN_LIST = '/oms/asnTemp/api/listByAsnCode';

    // 取消入库单
    const CANCEL_ASN = '/oms/asn/api/cancel';

    // 获取箱唛与 SKU 标签
    const GET_ASN_LABEL = '/oms/asnTemp/api/boxAndLabel';

    // 批量查询销退预收单
    const SALES_BACK_ORDER_LIST = '/oms/salesBackOrder/api/list';

    // 查询销退预收单详情
    const SALES_BACK_ORDER = '/oms/salesBackOrder/api/getByCode';

    // 销退预收单驳回
    const SALES_BACK_ORDER_REJECT = '/oms/salesBackOrder/api/customReject';

    // 销退预收单处理
    const SALES_BACK_ORDER_HANDLE = '/oms/salesBackOrder/api/customHandle';

    // 新建 2C 订单
    const CREATE_TOC_ORDER = '/oms/omsTocOrder/create';

    // 取消 2C 订单
    const CANCEL_TOC_ORDER = '/oms/omsTocOrder/cancel';

    // 根据订单号（或参考号）查询单个 2C 订单详情
    const GET_TOC_ORDER = '/oms/omsTocOrder/getByOrderNo';

    // 查询 2C 订单列表
    const TOC_ORDER_LIST = '/oms/omsTocOrder/listByOrderNos';

    // 创建 2B 订单
    const CREATE_TOB_ORDER = '/oms/tobOrder/create';

    // 取消 2B 订单
    const CANCEL_TOB_ORDER = '/oms/tobOrder/cancelExternal';

    // 查询 2B 订单详情
    const GET_TOB_ORDER = '/oms/tobOrder/getTobOrderInfoByExternal';

    // 创建 2C 退件订单
    const ADD_RETURN_ORDER = '/oms/omsReturnOrder/openapi/add2c';

    // 查询 2C 退件订单
    const GET_RETURN_ORDER = '/oms/omsReturnOrder/openapi/getByNo';

    // 取消 2C 退件订单
    const CANCEL_RETURN_ORDER = '/oms/omsReturnOrder/openapi/cancel';

    // 费用试算
    const EXPENSE_TRIAL = '/tms/expenseTrial/api/trial';

    // 获取费用账单
    const BILLING_LIST = '/bms/bmsSaleBilling/api/getByPage';
}